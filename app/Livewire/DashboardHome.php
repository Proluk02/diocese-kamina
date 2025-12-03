<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Post;
use App\Models\Parish;
use App\Models\Song;
use Illuminate\Support\Facades\Auth;

class DashboardHome extends Component
{
    public function render()
    {
        // Récupération des statistiques
        $stats = [
            'users_count' => User::count(),
            'priests_count' => User::where('role', 'priest')->count(),
            'parishes_count' => Parish::count(),
            // Articles en attente de validation (Urgent pour la Com)
            'pending_posts' => Post::where('status', 'pending')->count(),
            // Chants en attente (Urgent pour le responsable musique)
            'pending_songs' => Song::where('is_approved', false)->count(),
        ];

        // Récupérer les 5 derniers articles (peu importe le statut) pour afficher en bas
        $recentPosts = Post::with('user')->latest()->take(5)->get();

        return view('livewire.dashboard-home', [
            'stats' => $stats,
            'recentPosts' => $recentPosts
        ]);
    }
}