<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Parish;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Création des Catégories
        $catActualites = Category::create(['name' => 'Actualités', 'slug' => 'actualites', 'color' => 'blue']);
        $catHomelies = Category::create(['name' => 'Homélies', 'slug' => 'homelies', 'color' => 'gold']);
        $catEvents = Category::create(['name' => 'Événements', 'slug' => 'evenements', 'color' => 'red']);

        // 2. Création de quelques Paroisses
        $cathedrale = Parish::create([
            'name' => 'Cathédrale Sainte Thérèse',
            'city' => 'Kamina',
            'mass_schedules' => ['Dimanche' => '07h00, 10h00', 'Semaine' => '06h00']
        ]);
        
        $paroisseStJoseph = Parish::factory()->create(['name' => 'Paroisse Saint Joseph']);
        Parish::factory(3)->create(); // 3 autres paroisses au hasard

        // 3. CRÉATION DES UTILISATEURS (ROLES)

        // A. L'Administrateur (Chargé de Com) - ACCÈS TOTAL
        User::create([
            'name' => 'Admin Communication',
            'email' => 'admin@diocesekamina.org',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // B. L'Évêque
        User::create([
            'name' => 'Mgr l\'Évêque',
            'email' => 'eveque@diocesekamina.org',
            'password' => Hash::make('password'),
            'role' => 'bishop',
        ]);

        // C. Un Curé (Lié à Saint Joseph)
        $cure = User::create([
            'name' => 'Abbé Curé',
            'email' => 'cure@diocesekamina.org',
            'password' => Hash::make('password'),
            'role' => 'priest',
            'parish_id' => $paroisseStJoseph->id,
        ]);

        // D. Un Musicien
        User::create([
            'name' => 'Chef de Choeur',
            'email' => 'musicien@diocesekamina.org',
            'password' => Hash::make('password'),
            'role' => 'musician',
        ]);

        // 4. Création de faux articles
        Post::factory(10)->create([
            'user_id' => 1, // Admin
            'category_id' => $catActualites->id
        ]);
        
        Post::factory(5)->create([
            'user_id' => $cure->id, // Le curé
            'category_id' => $catHomelies->id,
            'status' => 'pending' // En attente de validation
        ]);
    }
}