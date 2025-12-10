<?php

namespace App\Livewire\Public\Liturgy;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Song;

class SongLibrary extends Component
{
    use WithPagination;

    public $search = '';
    public $moment = '';

    public $moments = [
        'Entrée', 'Kyrie', 'Gloria', 'Méditation', 'Acclamation', 
        'Credo', 'Prière Universelle', 'Offertoire', 'Sanctus', 
        'Agnus Dei', 'Communion', 'Action de grâce', 'Sortie', 'Louange'
    ];

    public function filterByMoment($m)
    {
        $this->moment = ($this->moment === $m) ? '' : $m; // Toggle
        $this->resetPage();
    }

    public function render()
    {
        $songs = Song::where('is_approved', true)
            ->when($this->search, fn($q) => $q->where('title', 'like', '%'.$this->search.'%'))
            ->when($this->moment, fn($q) => $q->where('liturgical_moment', $this->moment))
            ->latest()
            ->paginate(20);

        return view('livewire.public.liturgy.song-library', [
            'songs' => $songs
        ])->layout('layouts.guest');
    }
}