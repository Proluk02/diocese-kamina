<?php

namespace App\Livewire\Public;

use Livewire\Component;
use App\Models\Post;

class Home extends Component
{
    public function render()
    {
        return view('livewire.public.home', [
            // On récupère les 3 derniers articles publiés
            'latestPosts' => Post::where('status', 'published')
                                 ->latest()
                                 ->take(3)
                                 ->with('category', 'user')
                                 ->get()
        ])->layout('layouts.guest');
    }
}