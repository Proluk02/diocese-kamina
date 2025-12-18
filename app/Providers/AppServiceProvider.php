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
        // 1. SUPER ADMIN (Évêque, Chancelier, Com) : Accès TOUT
        Gate::define('manage-system', function (User $user) {
            return in_array($user->role, ['admin', 'bishop']);
        });

        // 2. GESTION CLERGÉ (Affectations) : Réservé à l'Évêché
        Gate::define('manage-clergy', function (User $user) {
            return in_array($user->role, ['admin', 'bishop']);
        });

        // 3. GESTION PAROISSE (Strict)
        // L'utilisateur peut modifier la paroisse SI :s
        // - C'est un Admin
        // - OU C'est le Curé/Secrétaire AFFECTÉ à cette paroisse précise
        Gate::define('manage-parish', function (User $user, Parish $parish) {
            if (in_array($user->role, ['admin', 'bishop'])) return true;

            return in_array($user->role, ['priest', 'secretary']) 
                && $user->parish_id === $parish->id;
        });
    }
}
