<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // On vérifie que la table existe pour ne pas planter lors des migrations
        if (Schema::hasTable('settings')) {
            // On récupère tout : ['site_name' => 'Diocèse...', 'contact_phone' => '...']
            $settings = Setting::all()->pluck('value', 'key')->toArray();
            
            // On partage la variable $S (plus court) avec toutes les vues
            View::share('S', $settings);
        }
    }
}