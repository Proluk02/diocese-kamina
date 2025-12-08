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

    public $search = '';
    public $filterStatus = ''; // 'approved', 'pending'
    public $isOpen = false;
    public $mode = 'create';

    // Champs
    public $songId;
    public $title;
    public $composer;
    public $liturgical_moment; // Entrée, Kyrie, etc.
    public $lyrics = ''; // Rich Text
    public $is_approved = false;
    
    // Fichiers
    public $audioFile;
    public $oldAudio;
    public $scoreFile; // Partition
    public $oldScore;

    public $currentSong;

    public $moments = [
        'Entrée', 'Kyrie', 'Gloria', 'Méditation', 'Acclamation', 
        'Credo', 'Prière Universelle', 'Offertoire', 'Sanctus', 
        'Agnus Dei', 'Communion', 'Action de grâce', 'Sortie', 'Louange'
    ];

    protected function rules()
    {
        $rules = [
            'title' => 'required|min:2',
            'composer' => 'nullable|string',
            'liturgical_moment' => 'required|string',
            'lyrics' => 'nullable|string',
            'is_approved' => 'boolean',
        ];

        // Validation des fichiers seulement à la création ou si modifiés
        if ($this->mode === 'create') {
            $rules['audioFile'] = 'nullable|file|mimes:mp3,wav,ogg|max:20480'; // 20MB
            $rules['scoreFile'] = 'nullable|file|mimes:pdf,jpg,png|max:5120'; // 5MB
        } else {
            $rules['audioFile'] = 'nullable|file|mimes:mp3,wav,ogg|max:20480';
            $rules['scoreFile'] = 'nullable|file|mimes:pdf,jpg,png|max:5120';
        }

        return $rules;
    }

    public function updatedSearch() { $this->resetPage(); }

    public function create()
    {
        $this->resetInputFields();
        $this->mode = 'create';
        $this->isOpen = true;
    }

    public function edit($id)
    {
        $song = Song::findOrFail($id);
        $this->songId = $id;
        $this->title = $song->title;
        $this->composer = $song->composer;
        $this->liturgical_moment = $song->liturgical_moment;
        $this->lyrics = $song->lyrics ?? '';
        $this->is_approved = (bool) $song->is_approved;
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

        $data = [
            'title' => $this->title,
            'composer' => $this->composer,
            'liturgical_moment' => $this->liturgical_moment,
            'lyrics' => $this->lyrics ?? '',
            'is_approved' => $this->is_approved,
            'user_id' => Auth::id(),
        ];

        // Upload Audio
        if ($this->audioFile) {
            if ($this->mode === 'edit' && $this->oldAudio) {
                Storage::disk('public')->delete($this->oldAudio);
            }
            $data['audio_path'] = $this->audioFile->store('songs/audio', 'public');
        }

        // Upload Partition
        if ($this->scoreFile) {
            if ($this->mode === 'edit' && $this->oldScore) {
                Storage::disk('public')->delete($this->oldScore);
            }
            $data['score_path'] = $this->scoreFile->store('songs/scores', 'public');
        }

        if ($this->mode === 'edit') {
            Song::find($this->songId)->update($data);
            session()->flash('success', 'Chant mis à jour.');
        } else {
            Song::create($data);
            session()->flash('success', 'Chant ajouté.');
        }

        $this->closeModal();
    }

    public function delete($id)
    {
        $song = Song::findOrFail($id);
        if ($song->audio_path) Storage::disk('public')->delete($song->audio_path);
        if ($song->score_path) Storage::disk('public')->delete($song->score_path);
        $song->delete();
        session()->flash('success', 'Chant supprimé.');
        if($this->isOpen) $this->closeModal();
    }

    public function toggleApproval($id)
    {
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
        $this->reset(['title', 'composer', 'liturgical_moment', 'audioFile', 'scoreFile', 'oldAudio', 'oldScore', 'songId', 'currentSong']);
        $this->lyrics = '';
        $this->is_approved = true; // Par défaut validé si c'est l'admin qui crée
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.admin.songs.song-index', [
            'songs' => Song::where('title', 'like', '%'.$this->search.'%')
                ->when($this->filterStatus === 'approved', fn($q) => $q->where('is_approved', true))
                ->when($this->filterStatus === 'pending', fn($q) => $q->where('is_approved', false))
                ->latest()
                ->paginate(10)
        ])->layout('layouts.app');
    }
}