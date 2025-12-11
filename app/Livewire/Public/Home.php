<?php

namespace App\Livewire\Public;

use Livewire\Component;
use App\Models\Post;
use App\Models\Setting; // Import Setting

class Home extends Component
{
    public function render()
    {
        // Récupérer les slides
        $slidesJson = Setting::where('key', 'home_slides')->value('value');
        $slides = json_decode($slidesJson ?? '[]', true);

        // Si vide, image par défaut
        if (empty($slides)) {
            $slides = ['default-hero.jpg']; // Assurez-vous d'avoir une image par défaut ou gérer le cas dans la vue
        }

        return view('livewire.public.home', [
            'slides' => $slides,
            'latestPosts' => Post::where('status', 'published')
                                 ->latest()
                                 ->take(3)
                                 ->with('category', 'user')
                                 ->get()
        ])->layout('layouts.guest');
    }
}