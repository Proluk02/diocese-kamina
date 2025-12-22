<?php

namespace App\Livewire\Admin\Songs;

use App\Models\Song;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class SongIndex extends Component
{
    use WithPagination, WithFileUploads;

    // Filtres
    public $search = '';
    public $filterStatus = '';
    public $filterSeason = ''; // Réintégré
    public $filterTheme = '';  // Réintégré

    // État Modale
    public $isOpen = false;
    public $mode = 'create';

    // Champs Formulaire
    public $songId;
    public $title;
    public $composer;
    public $composer_description; // Réintégré
    public $liturgical_moment;
    public $liturgical_season;    // Réintégré
    public $theme;                // Réintégré
    public $lyrics = '';          // Rich Text
    public $is_approved = false;
    
    // Fichiers
    public $audioFile;
    public $oldAudio;
    public $scoreFile;
    public $oldScore;

    // Pour l'affichage détail
    public $currentSong;

    // Constantes (Récupérées du Modèle)
    public $moments = Song::MOMENTS;
    public $seasons = Song::SEASONS;
    public $themes = Song::THEMES;

    protected function rules()
    {
        return [
            'title' => 'required|min:2',
            'composer' => 'nullable|string',
            'composer_description' => 'nullable|string',
            'liturgical_moment' => 'required|string',
            'liturgical_season' => 'nullable|string',
            'theme' => 'nullable|string',
            'lyrics' => 'nullable|string',
            'is_approved' => 'boolean',
            'audioFile' => 'nullable|file|mimes:mp3,wav,ogg|max:20480',
            'scoreFile' => 'nullable|file|mimes:pdf,jpg,png|max:5120',
        ];
    }

    public function mount()
    {
        $this->lyrics = ''; // Initialisation pour éviter le NULL
    }

    public function updatedSearch() { $this->resetPage(); }

    // --- ACTIONS ---

    public function create()
    {
        $this->resetInputFields();
        $this->mode = 'create';
        $this->isOpen = true;
    }

    public function edit($id)
    {
        $song = Song::findOrFail($id);
        
        // Sécurité
        if (Auth::user()->role === 'musician' && $song->user_id !== Auth::id()) {
            abort(403);
        }

        $this->songId = $id;
        $this->title = $song->title;
        $this->composer = $song->composer;
        $this->composer_description = $song->composer_description;
        $this->liturgical_moment = $song->liturgical_moment;
        $this->liturgical_season = $song->liturgical_season;
        $this->theme = $song->theme;
        
        // On force une chaine vide si null
        $this->lyrics = $song->lyrics ?? '';
        
        $this->is_approved = (bool)$song->is_approved;
        $this->oldAudio = $song->audio_path;
        $this->oldScore = $song->score_path;
        
        $this->mode = 'edit';
        $this->isOpen = true;
    }

    public function show($id)
    {
        $this->currentSong = Song::with('user')->findOrFail($id);
        $this->mode = 'show';
        $this->isOpen = true;
    }

    public function save()
    {
        $this->validate();
        $user = Auth::user();

        // Conversion explicite pour éviter le bug NULL
        $lyricsContent = is_null($this->lyrics) ? '' : (string) $this->lyrics;

        $data = [
            'title' => $this->title,
            'composer' => $this->composer,
            'composer_description' => $this->composer_description,
            'liturgical_moment' => $this->liturgical_moment,
            'liturgical_season' => $this->liturgical_season,
            'theme' => $this->theme,
            'lyrics' => $lyricsContent,
            'user_id' => $this->songId ? Song::find($this->songId)->user_id : $user->id,
        ];

        // Logique d'approbation
        if ($user->role === 'musician') {
            $data['is_approved'] = false; 
        } else {
            $data['is_approved'] = $this->is_approved;
        }

        // Fichiers
        if ($this->audioFile) {
            if ($this->mode === 'edit' && $this->oldAudio) Storage::disk('public')->delete($this->oldAudio);
            $data['audio_path'] = $this->audioFile->store('songs/audio', 'public');
        }

        if ($this->scoreFile) {
            if ($this->mode === 'edit' && $this->oldScore) Storage::disk('public')->delete($this->oldScore);
            $data['score_path'] = $this->scoreFile->store('songs/scores', 'public');
        }

        // Enregistrement
        if ($this->mode === 'edit') {
            Song::find($this->songId)->update($data);
            $msg = 'Chant mis à jour.';
        } else {
            Song::create($data);
            $msg = 'Chant ajouté.';
        }

        session()->flash('success', $msg);
        $this->closeModal();
    }

    public function delete($id)
    {
        $song = Song::findOrFail($id);
        if ($song->audio_path) Storage::disk('public')->delete($song->audio_path);
        if ($song->score_path) Storage::disk('public')->delete($song->score_path);
        $song->delete();
        session()->flash('success', 'Chant supprimé.');
        
        // Si on est dans la modale, on la ferme
        if($this->isOpen) $this->closeModal();
    }

    public function toggleApproval($id)
    {
        if (Auth::user()->role === 'musician') return;
        $song = Song::findOrFail($id);
        $song->is_approved = !$song->is_approved;
        $song->save();
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->reset([
            'title', 'composer', 'composer_description', 
            'liturgical_moment', 'liturgical_season', 'theme', 
            'audioFile', 'scoreFile', 'oldAudio', 'oldScore', 
            'songId', 'currentSong'
        ]);
        $this->lyrics = ''; 
        $this->is_approved = Auth::user()->isAdmin(); 
        $this->resetErrorBag();
    }

    public function render()
    {
        $user = Auth::user();
        $query = Song::query();

        if ($user->role === 'musician') {
            $query->where('user_id', $user->id);
        }

        $query->where('title', 'like', '%'.$this->search.'%')
            ->when($this->filterStatus === 'approved', fn($q) => $q->where('is_approved', true))
            ->when($this->filterStatus === 'pending', fn($q) => $q->where('is_approved', false))
            // Filtres supplémentaires réintégrés
            ->when($this->filterSeason, fn($q) => $q->where('liturgical_season', $this->filterSeason))
            ->when($this->filterTheme, fn($q) => $q->where('theme', $this->filterTheme))
            ->latest();

        return view('livewire.admin.songs.song-index', [
            'songs' => $query->paginate(10)
        ])->layout('layouts.app');
    }
}