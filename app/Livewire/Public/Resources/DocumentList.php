<?php

namespace App\Livewire\Public\Resources;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class DocumentList extends Component
{
    use WithPagination;

    public $type = ''; 
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

    // Nouvelle fonction pour forcer le téléchargement
    public function download($documentId)
    {
        $document = Document::findOrFail($documentId);

        if (!$document->file_path || !Storage::disk('public')->exists($document->file_path)) {
            session()->flash('error', 'Le fichier n\'existe pas.');
            return;
        }

        // On génère un nom de fichier propre basé sur le titre
        $extension = pathinfo($document->file_path, PATHINFO_EXTENSION);
        $fileName = \Str::slug($document->title) . '.' . $extension;

        return Storage::disk('public')->download($document->file_path, $fileName);
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