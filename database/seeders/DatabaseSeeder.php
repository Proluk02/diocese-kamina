<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Parish;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. CRÉATION DES CATÉGORIES (Indispensable pour le Blog)
        // ------------------------------------------------------
        $catActualites = Category::create(['name' => 'Actualités', 'slug' => 'actualites', 'color' => 'blue']);
        $catHomelies = Category::create(['name' => 'Homélies', 'slug' => 'homelies', 'color' => 'gold']);
        $catEvents = Category::create(['name' => 'Événements', 'slug' => 'evenements', 'color' => 'red']);
        $catComm = Category::create(['name' => 'Communiqués', 'slug' => 'communiques', 'color' => 'purple']);

        // 2. CRÉATION DES PAROISSES DE BASE (Nécessaire pour lier les prêtres)
        // ------------------------------------------------------
        $cathedrale = Parish::create([
            'name' => 'Cathédrale Sainte Thérèse',
            'city' => 'Kamina',
            'address' => 'Avenue de la Mission, Centre-Ville',
            'contact_phone' => '+243 999 000 111',
            'mass_schedules' => '<p><strong>Dimanche :</strong> 06h30 (Swahili), 09h00 (Français), 17h00 (Vêpres)</p>',
        ]);
        
        $paroisseStJoseph = Parish::create([
            'name' => 'Paroisse Saint Joseph',
            'city' => 'Kamina',
            'address' => 'Quartier Industriel',
            'mass_schedules' => '<p><strong>Dimanche :</strong> 07h30 et 10h00</p>',
        ]);

        // 3. CRÉATION DES UTILISATEURS & RESPONSABLES
        // ------------------------------------------------------

        // A. SUPER ADMIN (IT / Technique)
        // Accès : TOTAL
        User::create([
            'name' => 'Super Administrateur',
            'email' => 'admin@diocesekamina.org',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        // B. L'ÉVÊQUE
        // Accès : Gestion Clergé, Visibilité Totale
        User::create([
            'name' => 'Mgr Léonard KAKUDJI',
            'email' => 'eveque@diocesekamina.org',
            'password' => Hash::make('password'),
            'role' => 'bishop',
            'is_active' => true,
        ]);

        // C. LE CHANCELIER (Bras droit)
        // Accès : Gestion Clergé, Paroisses, Documents
        User::create([
            'name' => 'Abbé Chancelier',
            'email' => 'chancelier@diocesekamina.org',
            'password' => Hash::make('password'),
            'role' => 'admin', // Rôle admin pour gérer le système
            'is_active' => true,
            'parish_id' => $cathedrale->id,
        ]);

        // D. CHARGÉ DE COMMUNICATION
        // Accès : Validation des Articles, Publication Documents
        User::create([
            'name' => 'Service Communication',
            'email' => 'com@diocesekamina.org',
            'password' => Hash::make('password'),
            'role' => 'admin', // Rôle admin pour valider les contenus
            'is_active' => true,
        ]);

        // E. CHARGÉ DE LA LITURGIE
        // Accès : Validation des Musiciens et des Chants
        User::create([
            'name' => 'Commission Liturgique',
            'email' => 'liturgie@diocesekamina.org',
            'password' => Hash::make('password'),
            'role' => 'admin', // Rôle admin pour valider les chants (is_approved)
            'is_active' => true,
        ]);

        // 4. EXEMPLES D'UTILISATEURS STANDARD
        // ------------------------------------------------------

        // F. Un Curé (Pour tester l'accès restreint à sa paroisse)
        User::create([
            'name' => 'Abbé Curé St Joseph',
            'email' => 'cure@diocesekamina.org',
            'password' => Hash::make('password'),
            'role' => 'priest',
            'parish_id' => $paroisseStJoseph->id,
            'is_active' => true,
        ]);

        // G. Un Musicien (Pour tester la soumission de chants)
        User::create([
            'name' => 'Maître de Choeur',
            'email' => 'musicien@diocesekamina.org',
            'password' => Hash::make('password'),
            'role' => 'musician',
            'is_active' => true, // Compte déjà validé pour le test
        ]);
    }
} 