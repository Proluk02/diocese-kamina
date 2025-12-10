<?php

namespace App\Livewire\Public\Parishes;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Parish;

class ParishList extends Component
{
    use WithPagination;

    public $search = '';
    public $city = '';

    // Pour le filtre de ville
    public $cities = ['Kamina', 'Kinkondja', 'Kabondo Dianda', 'Malemba-Nkulu']; 

    public function updatedSearch() { $this->resetPage(); }
    public function updatedCity() { $this->resetPage(); }

    public function render()
    {
        $parishes = Parish::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', '%'.$this->search.'%'))
            ->when($this->city, fn($q) => $q->where('city', $this->city))
            ->orderBy('name')
            ->paginate(9);

        return view('livewire.public.parishes.parish-list', [
            'parishes' => $parishes
        ])->layout('layouts.guest');
    }
}