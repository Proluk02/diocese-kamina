<?php

namespace App\Livewire\Admin\Documents;

use App\Models\Document;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DocumentIndex extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $filterType = '';
    public $isOpen = false;
    public $mode = 'create'; 

    public $docId;
    public $title;
    
    // IMPORTANT : Initialisation explicite à null
    public $description = null;
    
    public $type = 'homelie';
    public $video_link;
    public $file;
    public $oldFile;
    public $is_downloadable = true;
    public $currentDoc;

    public $types = [
        'homelie' => 'Homélie',
        'lettre' => 'Lettre Pastorale',
        'communique' => 'Communiqué',
        'rapport' => 'Rapport',
        'autre' => 'Autre'
    ];

    protected function rules()
    {
        return [
            'title' => 'required|min:3',
            'type' => 'required|in:homelie,lettre,communique,rapport,autre',
            'description' => 'nullable|string', // Nullable autorisé
            'video_link' => 'nullable|url',
            'is_downloadable' => 'boolean',
            'file' => 'nullable|mimes:pdf|max:10240',
        ];
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
        $doc = Document::findOrFail($id);
        $this->docId = $id;
        $this->title = $doc->title;
        
        // On récupère la description (si null, reste null)
        $this->description = $doc->description; 
        
        $this->type = $doc->type;
        $this->video_link = $doc->video_link;
        $this->is_downloadable = (bool) $doc->is_downloadable;
        $this->oldFile = $doc->file_path;
        
        $this->mode = 'edit';
        $this->isOpen = true;
    }

    public function show($id)
    {
        $this->currentDoc = Document::findOrFail($id);
        $this->mode = 'show';
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->reset(['title', 'type', 'video_link', 'file', 'oldFile', 'docId', 'currentDoc']);
        $this->description = null; // Reset propre
        $this->is_downloadable = true;
        $this->resetErrorBag();
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'description' => $this->description, // Sera null ou une string HTML
            'type' => $this->type,
            'video_link' => $this->video_link,
            'is_downloadable' => $this->is_downloadable,
            'user_id' => Auth::id(),
        ];

        if ($this->file) {
            if ($this->mode === 'edit' && $this->oldFile) {
                Storage::disk('public')->delete($this->oldFile);
            }
            $data['file_path'] = $this->file->store('documents', 'public');
        }

        if ($this->mode === 'edit') {
            Document::find($this->docId)->update($data);
            session()->flash('success', 'Document mis à jour.');
        } else {
            Document::create($data);
            session()->flash('success', 'Document ajouté.');
        }

        $this->closeModal();
    }

    public function delete($id)
    {
        $doc = Document::findOrFail($id);
        if ($doc->file_path) Storage::disk('public')->delete($doc->file_path);
        $doc->delete();
        session()->flash('success', 'Supprimé.');
        if($this->isOpen) $this->closeModal();
    }

    public function getYoutubeEmbedUrl($url)
    {
        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }
        return null;
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