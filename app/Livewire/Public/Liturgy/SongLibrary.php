<?php

namespace App\Livewire\Public\Liturgy;

use App\Models\Song;
use Livewire\Component;
use Livewire\WithPagination;

class SongLibrary extends Component
{
    use WithPagination;

    public $search = '';
    public $moment = ''; // Filtre par moment liturgique (Entrée, Kyrie...)

    public $moments = [
        'Entrée', 'Kyrie', 'Gloria', 'Méditation', 'Acclamation', 
        'Credo', 'Prière Universelle', 'Offertoire', 'Sanctus', 
        'Agnus Dei', 'Communion', 'Action de grâce', 'Sortie', 'Louange'
    ];

    public function updatedSearch() { $this->resetPage(); }
    public function updatedMoment() { $this->resetPage(); }

    public function render()
    {
        $songs = Song::where('is_approved', true) // Seulement les validés
            ->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('composer', 'like', '%' . $this->search . '%');
            })
            ->when($this->moment, function($q) {
                $q->where('liturgical_moment', $this->moment);
            })
            ->orderBy('title', 'asc')
            ->paginate(12);

        return view('livewire.public.liturgy.song-library', [
            'songs' => $songs
        ])->layout('layouts.guest');
    }
}