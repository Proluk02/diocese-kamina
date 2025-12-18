<?php

namespace App\Livewire\Public\Liturgy;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Song;

class SongLibrary extends Component
{
    use WithPagination;

    public $search = '';
    
    // Filtres multiples
    public $filterMoment = '';
    public $filterSeason = '';
    public $filterTheme = '';

    // Constantes
    public $moments = Song::MOMENTS;
    public $seasons = Song::SEASONS;
    public $themes = Song::THEMES;

    public function updatedSearch() { $this->resetPage(); }
    public function updatedFilterMoment() { $this->resetPage(); }
    public function updatedFilterSeason() { $this->resetPage(); }
    public function updatedFilterTheme() { $this->resetPage(); }

    public function resetFilters()
    {
        $this->reset(['filterMoment', 'filterSeason', 'filterTheme', 'search']);
    }

    // Helpers pour la vue (filtre rapide)
    public function filterByMoment($m) { $this->filterMoment = ($this->filterMoment === $m) ? '' : $m; $this->resetPage(); }
    public function filterBySeason($s) { $this->filterSeason = ($this->filterSeason === $s) ? '' : $s; $this->resetPage(); }
    public function filterByTheme($t) { $this->filterTheme = ($this->filterTheme === $t) ? '' : $t; $this->resetPage(); }

    public function render()
    {
        $songs = Song::where('is_approved', true)
            ->where(function($query) {
                $query->where('title', 'like', '%'.$this->search.'%')
                      ->orWhere('composer', 'like', '%'.$this->search.'%');
            })
            ->when($this->filterMoment, fn($q) => $q->where('liturgical_moment', $this->filterMoment))
            ->when($this->filterSeason, fn($q) => $q->where('liturgical_season', $this->filterSeason))
            ->when($this->filterTheme, fn($q) => $q->where('theme', $this->filterTheme))
            ->latest()
            ->paginate(15);

        return view('livewire.public.liturgy.song-library', [
            'songs' => $songs
        ])->layout('layouts.guest');
    }
}