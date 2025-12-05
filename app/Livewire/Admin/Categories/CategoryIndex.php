<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class CategoryIndex extends Component
{
    use WithPagination;

    // Variables
    public $search = '';
    
    // Modal state
    public $isOpen = false;
    public $isEdit = false;

    // Form fields
    public $categoryId;
    public $name;
    public $slug;
    public $color = 'blue'; // blue, red, green, yellow, purple, gray

    // Liste des couleurs disponibles pour l'UI
    public $colors = [
        'blue' => 'Bleu',
        'green' => 'Vert',
        'red' => 'Rouge',
        'yellow' => 'Jaune',
        'purple' => 'Violet',
        'gray' => 'Gris',
        'gold' => 'Doré (Kamina)',
    ];

    protected function rules()
    {
        return [
            'name' => 'required|min:3|unique:categories,name,' . $this->categoryId,
            'color' => 'required',
        ];
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->color = $category->color;
        
        $this->isEdit = true;
        $this->openModal();
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'color' => $this->color,
        ];

        if ($this->categoryId) {
            Category::find($this->categoryId)->update($data);
            session()->flash('success', 'Catégorie mise à jour.');
        } else {
            Category::create($data);
            session()->flash('success', 'Catégorie créée.');
        }

        $this->closeModal();
    }

    public function delete($id)
    {
        // On empêche la suppression si des articles sont liés (optionnel mais recommandé)
        $category = Category::withCount('posts')->findOrFail($id);
        
        if ($category->posts_count > 0) {
            session()->flash('error', 'Impossible de supprimer : cette catégorie contient des articles.');
            return;
        }

        $category->delete();
        session()->flash('success', 'Catégorie supprimée.');
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->categoryId = null;
        $this->name = '';
        $this->slug = '';
        $this->color = 'blue';
        $this->isEdit = false;
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.admin.categories.category-index', [
            'categories' => Category::withCount('posts')
                ->where('name', 'like', '%' . $this->search . '%')
                ->latest()
                ->paginate(10)
        ])->layout('layouts.app');
    }
}