<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Parish;
use App\Models\Category;
use App\Models\Post;
use App\Models\Document;
use App\Models\Song;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. CRÉATION DES CATÉGORIES
        // ------------------------------------------------------
        $catActualites = Category::create(['name' => 'Actualités', 'slug' => 'actualites', 'color' => 'blue']);
        $catHomelies = Category::create(['name' => 'Homélies', 'slug' => 'homelies', 'color' => 'gold']);
        $catEvents = Category::create(['name' => 'Événements', 'slug' => 'evenements', 'color' => 'red']);
        $catComm = Category::create(['name' => 'Communiqués', 'slug' => 'communiques', 'color' => 'purple']);

        // 2. CRÉATION DES PAROISSES (Avec contenu Rich Text HTML)
        // ------------------------------------------------------
        $cathedrale = Parish::create([
            'name' => 'Cathédrale Sainte Thérèse',
            'city' => 'Kamina',
            'address' => 'Avenue de la Mission, Centre-Ville',
            'contact_phone' => '+243 999 000 111',
            // On simule ce que l'éditeur Quill génère (HTML)
            'mass_schedules' => '
                <p><strong>Dimanche :</strong></p>
                <ul>
                    <li>06h30 : Première messe (Swahili)</li>
                    <li>09h00 : Grand messe (Français)</li>
                    <li>17h00 : Vêpres</li>
                </ul>
                <p><strong>Semaine :</strong></p>
                <p>Chaque matin à 06h00 (Mardi à Samedi)</p>
            ',
            'history' => '<p>La cathédrale est le cœur du diocèse, fondée en 19XX...</p>'
        ]);
        
        $paroisseStJoseph = Parish::create([
            'name' => 'Paroisse Saint Joseph',
            'city' => 'Kamina',
            'address' => 'Quartier Industriel',
            'mass_schedules' => '<p><strong>Dimanche :</strong> 07h30 et 10h00</p>',
        ]);

        // Création de 3 autres paroisses aléatoires via Factory
        // Note: Assurez-vous que ParishFactory génère bien une string pour mass_schedules, sinon on force ici
        Parish::factory(3)->create([
            'mass_schedules' => '<p>Horaires à définir par le secrétariat.</p>'
        ]); 

        // 3. CRÉATION DES UTILISATEURS (ROLES)
        // ------------------------------------------------------

        // A. L'Administrateur (Chargé de Com) - ACCÈS TOTAL
        $admin = User::create([
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

        // D. Une Secrétaire (Liée à la Cathédrale)
        User::create([
            'name' => 'Sœur Secrétaire',
            'email' => 'secretaire@diocesekamina.org',
            'password' => Hash::make('password'),
            'role' => 'secretary',
            'parish_id' => $cathedrale->id,
        ]);

        // E. Un Musicien
        $musicien = User::create([
            'name' => 'Chef de Choeur',
            'email' => 'musicien@diocesekamina.org',
            'password' => Hash::make('password'),
            'role' => 'musician',
        ]);

        // 4. CRÉATION DE CONTENU (ARTICLES)
        // ------------------------------------------------------
        Post::factory(8)->create([
            'user_id' => $admin->id, // Admin
            'category_id' => $catActualites->id,
            'status' => 'published'
        ]);
        
        Post::factory(3)->create([
            'user_id' => $cure->id, // Le curé
            'category_id' => $catHomelies->id,
            'status' => 'pending' // En attente de validation
        ]);

        // 5. CRÉATION DE DOCUMENTS (NOUVEAU MODULE)
        // ------------------------------------------------------
        
        // Doc 1 : Une homélie avec Vidéo Youtube
        Document::create([
            'title' => 'Homélie de Pâques 2024',
            'type' => 'homelie',
            'description' => '<p>Retrouvez ici le message d\'espérance prononcé lors de la vigile pascale.</p>',
            'video_link' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', // Exemple Lien (RickRoll pour le test :D)
            'is_downloadable' => true,
            'user_id' => $admin->id,
        ]);

        // Doc 2 : Un communiqué officiel (Texte seulement)
        Document::create([
            'title' => 'Nomination des nouveaux vicaires',
            'type' => 'communique',
            'description' => '<p><strong>Le Diocèse annonce les nominations suivantes :</strong></p><ul><li>Abbé Jean : Vicaire St Joseph</li><li>Abbé Paul : Aumônier des Jeunes</li></ul>',
            'is_downloadable' => false,
            'user_id' => $admin->id,
        ]);

        // 6. CRÉATION DE CHANTS (POUR LES STATS)
        // ------------------------------------------------------
        Song::create([
            'title' => 'Gloire à Dieu (Messe Solennelle)',
            'composer' => 'Abbé Compositeur',
            'liturgical_moment' => 'Gloria',
            'user_id' => $musicien->id,
            'is_approved' => false, // En attente
        ]);

        Song::create([
            'title' => 'Tu es le Dieu fidèle',
            'composer' => 'Chorale St Kisito',
            'liturgical_moment' => 'Action de grâce',
            'user_id' => $musicien->id,
            'is_approved' => true,
        ]);
    }
}