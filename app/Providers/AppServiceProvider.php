<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Parish;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Accès au Dashboard Admin Global
        Gate::define('access-admin', function (User $user) {
            return in_array($user->role, ['admin', 'bishop', 'secretary', 'priest', 'musician']);
        });

        // Super Admin (Peut tout faire)
        Gate::define('manage-system', function (User $user) {
            return in_array($user->role, ['admin', 'bishop']);
        });

        // Gestion des Paroisses (Seulement sa propre paroisse)
        Gate::define('update-parish', function (User $user, Parish $parish) {
            if ($user->role === 'admin' || $user->role === 'bishop') return true;
            
            // Si c'est un prêtre ou secrétaire, il doit être lié à la paroisse
            return in_array($user->role, ['priest', 'secretary']) && $user->parish_id === $parish->id;
        });

        // Gestion Musique
        Gate::define('manage-music', function (User $user) {
            return in_array($user->role, ['admin', 'musician']);
        });
    }
}
