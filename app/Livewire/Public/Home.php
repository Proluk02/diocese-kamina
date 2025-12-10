<?php

namespace App\Livewire\Public;

use Livewire\Component;
use App\Models\Post;

class Home extends Component
{
    public function render()
    {
        // Récupération des 3 derniers articles publiés pour la page d'accueil
        $latestPosts = Post::with(['category', 'user']) // Optimisation : Charge la catégorie et l'auteur
            ->where('status', 'published')              // Filtre : Uniquement les articles publiés
            ->latest()                                  // Tri : Du plus récent au plus ancien
            ->take(3)                                   // Limite : 3 articles pour la grille
            ->get();

        return view('livewire.public.home', [
            'latestPosts' => $latestPosts
        ])->layout('layouts.guest'); // Utilise le layout public (Navbar + Footer)
    }
}