<?php

namespace App\Livewire\Admin\Documents;

use App\Models\Document;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads; // Indispensable pour les fichiers
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DocumentIndex extends Component
{
    use WithPagination, WithFileUploads;

    // Filtres
    public $search = '';
    public $filterType = '';

    // Modale
    public $isOpen = false;
    public $isEdit = false;

    // Champs
    public $docId;
    public $title;
    public $description;
    public $type = 'homelie'; // homelie, lettre, communique, autre
    public $file; // Le fichier temporaire uploadé
    public $oldFile; // Le chemin du fichier existant (pour l'édition)
    public $is_downloadable = true;

    // Types de documents pour le select
    public $types = [
        'homelie' => 'Homélie',
        'lettre' => 'Lettre Pastorale',
        'communique' => 'Communiqué Officiel',
        'rapport' => 'Rapport / Compte-rendu',
        'autre' => 'Autre document'
    ];

    protected function rules()
    {
        $rules = [
            'title' => 'required|min:3',
            'type' => 'required|in:homelie,lettre,communique,rapport,autre',
            'description' => 'nullable|string',
            'is_downloadable' => 'boolean',
        ];

        // Le fichier est obligatoire seulement à la création
        if (!$this->isEdit) {
            $rules['file'] = 'required|mimes:pdf|max:10240'; // PDF max 10MB
        } else {
            $rules['file'] = 'nullable|mimes:pdf|max:10240';
        }

        return $rules;
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function edit($id)
    {
        $doc = Document::findOrFail($id);
        $this->docId = $id;
        $this->title = $doc->title;
        $this->description = $doc->description;
        $this->type = $doc->type;
        $this->is_downloadable = (bool) $doc->is_downloadable;
        $this->oldFile = $doc->file_path;
        
        $this->isEdit = true;
        $this->openModal();
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'type' => $this->type,
            'is_downloadable' => $this->is_downloadable,
            'user_id' => Auth::id(),
        ];

        // Gestion du fichier
        if ($this->file) {
            // Si on édite et qu'il y a déjà un fichier, on le supprime
            if ($this->isEdit && $this->oldFile) {
                Storage::disk('public')->delete($this->oldFile);
            }
            // Sauvegarde du nouveau (dans le dossier 'documents')
            $data['file_path'] = $this->file->store('documents', 'public');
        }

        if ($this->isEdit) {
            Document::find($this->docId)->update($data);
            session()->flash('success', 'Document mis à jour.');
        } else {
            Document::create($data);
            session()->flash('success', 'Document ajouté avec succès.');
        }

        $this->closeModal();
    }

    public function delete($id)
    {
        $doc = Document::findOrFail($id);
        
        // Supprimer le fichier physique
        if ($doc->file_path) {
            Storage::disk('public')->delete($doc->file_path);
        }
        
        $doc->delete();
        session()->flash('success', 'Document supprimé définitivement.');
    }

    public function openModal() { $this->isOpen = true; }
    
    public function closeModal() 
    { 
        $this->isOpen = false; 
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->reset(['title', 'description', 'type', 'file', 'oldFile', 'docId', 'isEdit']);
        $this->is_downloadable = true;
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.admin.documents.document-index', [
            'documents' => Document::where('title', 'like', '%'.$this->search.'%')
                ->when($this->filterType, fn($q) => $q->where('type', $this->filterType))
                ->latest()
                ->paginate(10)
        ])->layout('layouts.app');
    }
}