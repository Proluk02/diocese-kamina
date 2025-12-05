<?php

namespace App\Livewire\Admin\Articles;

use App\Models\Post;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ArticleIndex extends Component
{
    use WithPagination, WithFileUploads;

    // Filtres
    public $search = '';
    public $filterStatus = '';

    // État de la Modale
    public $isOpen = false;
    public $mode = 'create'; // 'create', 'edit', 'show'

    // Données du formulaire
    public $postId;
    public $title, $slug, $category_id, $body, $status = 'draft';
    public $image, $existingImage;
    
    // Données pour le mode "Show"
    public $currentPost; 

    protected function rules()
    {
        return [
            'title' => 'required|min:5',
            'category_id' => 'required|exists:categories,id',
            'body' => 'required',
            'status' => 'required|in:draft,published,pending',
            'image' => 'nullable|image|max:5120', // 5MB Max
        ];
    }

    public function updatedSearch() { $this->resetPage(); }

    // --- GESTION MODALE ---

    public function create()
    {
        $this->resetInputFields();
        $this->mode = 'create';
        $this->isOpen = true;
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->postId = $id;
        $this->title = $post->title;
        $this->category_id = $post->category_id;
        $this->body = $post->body;
        $this->status = $post->status;
        $this->existingImage = $post->image_path;
        
        $this->mode = 'edit';
        $this->isOpen = true;
    }

    public function show($id)
    {
        $this->currentPost = Post::with(['category', 'user'])->findOrFail($id);
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
        $this->reset(['title', 'slug', 'category_id', 'body', 'status', 'image', 'existingImage', 'postId', 'currentPost']);
        $this->resetErrorBag();
    }

    // --- CRUD ---

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'category_id' => $this->category_id,
            'body' => $this->body,
            'status' => $this->status,
        ];

        // Traitement de l'image
        if ($this->image) {
            // Si modification, on supprime l'ancienne
            if ($this->postId && $this->existingImage) {
                Storage::disk('public')->delete($this->existingImage);
            }
            $data['image_path'] = $this->image->store('posts', 'public');
        }

        if ($this->postId) {
            // UPDATE
            $post = Post::findOrFail($this->postId);
            $post->update($data);
            session()->flash('success', 'Article mis à jour avec succès.');
        } else {
            // CREATE
            $data['user_id'] = Auth::id();
            $data['published_at'] = $this->status === 'published' ? now() : null;
            Post::create($data);
            session()->flash('success', 'Article créé avec succès.');
        }

        $this->closeModal();
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);
        if ($post->image_path) {
            Storage::disk('public')->delete($post->image_path);
        }
        $post->delete();
        session()->flash('success', 'Article supprimé.');
        
        // Si on était en mode show, on ferme la modale
        if($this->isOpen) $this->closeModal();
    }

    public function render()
    {
        return view('livewire.admin.articles.article-index', [
            'posts' => Post::with('category', 'user')
                ->where('title', 'like', '%' . $this->search . '%')
                ->when($this->filterStatus, fn($q) => $q->where('status', $this->filterStatus))
                ->latest()
                ->paginate(10),
            'categories' => Category::all()
        ])->layout('layouts.app');
    }
}