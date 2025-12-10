<?php

namespace App\Livewire\Public\News;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;
use App\Models\Category;

class ArticleList extends Component
{
    use WithPagination;

    public $category = '';

    public function filterByCategory($slug)
    {
        $this->category = $slug;
        $this->resetPage();
    }

    public function render()
    {
        $posts = Post::where('status', 'published')
            ->when($this->category, function($q) {
                $q->whereHas('category', fn($c) => $c->where('slug', $this->category));
            })
            ->latest()
            ->paginate(9);

        return view('livewire.public.news.article-list', [
            'posts' => $posts,
            'categories' => Category::has('posts')->get()
        ])->layout('layouts.guest');
    }
}