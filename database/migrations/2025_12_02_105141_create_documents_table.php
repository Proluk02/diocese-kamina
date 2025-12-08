<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            
            // COMBINÉ : On utilise longText pour le contenu HTML (Quill) 
            // et nullable pour éviter l'erreur SQL si c'est vide.
            $table->longText('description')->nullable();
            
            // MODIFIÉ : On le met nullable au cas où l'utilisateur 
            // ajoute seulement une vidéo sans fichier PDF joint.
            $table->string('file_path')->nullable(); 
            
            // COMBINÉ : Ajout direct de la colonne vidéo
            $table->string('video_link')->nullable();
            
            $table->string('type'); // 'homelie', 'lettre', 'communique', etc.
            
            // Autorisation de téléchargement
            $table->boolean('is_downloadable')->default(true);
            
            // Liaison avec l'utilisateur (avec suppression en cascade si l'user est supprimé)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};