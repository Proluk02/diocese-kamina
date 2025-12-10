<?php

namespace App\Livewire\Public\Parishes;

use App\Models\Parish;
use Livewire\Component;
use Livewire\WithPagination;

class ParishList extends Component
{
    use WithPagination;

    public $search = '';

    // Reset la pagination quand on cherche
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $parishes = Parish::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('city', 'like', '%' . $this->search . '%')
            ->orderBy('name', 'asc')
            ->paginate(9);

        return view('livewire.public.parishes.parish-list', [
            'parishes' => $parishes
        ])->layout('layouts.guest'); // On utilise le layout public créé ensemble
    }
}