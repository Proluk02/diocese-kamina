<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Post;
use App\Models\Parish;
use App\Models\Song;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;

class DashboardHome extends Component
{
    public function render()
    {
        $user = Auth::user();
        $stats = [];
        $recentItems = [];
        $viewType = 'admin'; // admin, musician, clergy

        // --- 1. LOGIQUE MUSICIEN ---
        if ($user->role === 'musician') {
            $viewType = 'musician';
            
            $stats = [
                [
                    'label' => 'Mes Chants',
                    'value' => Song::where('user_id', $user->id)->count(),
                    'icon' => 'music',
                    'color' => 'blue',
                ],
                [
                    'label' => 'En attente',
                    'value' => Song::where('user_id', $user->id)->where('is_approved', false)->count(),
                    'icon' => 'clock',
                    'color' => 'yellow',
                ],
                [
                    'label' => 'Validés',
                    'value' => Song::where('user_id', $user->id)->where('is_approved', true)->count(),
                    'icon' => 'check',
                    'color' => 'green',
                ]
            ];

            $recentItems = Song::where('user_id', $user->id)->latest()->take(5)->get();
        } 
        
        // --- 2. LOGIQUE CLERGÉ (Prêtre/Secrétaire) ---
        elseif (in_array($user->role, ['priest', 'secretary'])) {
            $viewType = 'clergy';
            
            $stats = [
                [
                    'label' => 'Mes Articles',
                    'value' => Post::where('user_id', $user->id)->count(),
                    'icon' => 'document-text',
                    'color' => 'blue',
                ],
                [
                    'label' => 'Documents',
                    'value' => Document::where('user_id', $user->id)->count(),
                    'icon' => 'folder',
                    'color' => 'purple',
                ],
                [
                    'label' => 'Paroisse',
                    'value' => $user->parish ? $user->parish->name : 'Non assigné',
                    'is_text' => true, // Pour afficher du texte au lieu d'un nombre
                    'icon' => 'home',
                    'color' => 'green',
                ]
            ];

            $recentItems = Post::where('user_id', $user->id)->latest()->take(5)->get();
        } 
        
        // --- 3. LOGIQUE ADMIN (Super Admin / Évêque) ---
        else {
            $stats = [
                [
                    'label' => 'Utilisateurs',
                    'value' => User::count(),
                    'icon' => 'users',
                    'color' => 'blue',
                ],
                [
                    'label' => 'Paroisses',
                    'value' => Parish::count(),
                    'icon' => 'home',
                    'color' => 'green',
                ],
                [
                    'label' => 'Articles à valider',
                    'value' => Post::where('status', 'pending')->count(),
                    'icon' => 'pencil',
                    'color' => 'yellow',
                    'alert' => true // Pour mettre en rouge si > 0
                ],
                [
                    'label' => 'Chants à valider',
                    'value' => Song::where('is_approved', false)->count(),
                    'icon' => 'music',
                    'color' => 'purple',
                    'alert' => true
                ],
            ];

            // Les admins voient tout ce qui bouge
            $recentItems = Post::with('user')->latest()->take(5)->get();
        }

        return view('livewire.dashboard-home', [
            'stats' => $stats,
            'recentItems' => $recentItems,
            'viewType' => $viewType,
            'user' => $user
        ]);
    }
}