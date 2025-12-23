<?php

namespace App\Livewire\Public\News;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Str; // Importation nécessaire pour Str::limit

class ArticleShow extends Component
{
    public $post;

    public function mount($slug)
    {
        $this->post = Post::where('slug', $slug)
                          ->where('status', 'published')
                          ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.public.news.article-show', [
            'relatedPosts' => Post::where('category_id', $this->post->category_id)
                                  ->where('id', '!=', $this->post->id)
                                  ->where('status', 'published')
                                  ->take(3)
                                  ->get()
        ])
        ->layout('layouts.guest')
        ->title($this->post->title)
        ->layoutData(['description' => Str::limit(strip_tags($this->post->body), 150)]); 
    }
}