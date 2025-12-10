<?php

namespace App\Livewire\Public\Resources;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Document;

class DocumentList extends Component
{
    use WithPagination;

    public $type = ''; // homelie, lettre, etc.
    public $search = '';

    public $types = [
        'homelie' => 'Homélies',
        'lettre' => 'Lettres Pastorales',
        'communique' => 'Communiqués',
        'rapport' => 'Rapports',
        'autre' => 'Autres'
    ];

    public function filterByType($type)
    {
        $this->type = $type;
        $this->resetPage();
    }

    public function render()
    {
        $documents = Document::query()
            ->when($this->type, fn($q) => $q->where('type', $this->type))
            ->when($this->search, fn($q) => $q->where('title', 'like', '%'.$this->search.'%'))
            ->latest()
            ->paginate(12);

        return view('livewire.public.resources.document-list', [
            'documents' => $documents
        ])->layout('layouts.guest');
    }
}