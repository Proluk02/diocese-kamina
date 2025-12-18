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
        // On vérifie si la table existe déjà pour éviter les conflits, 
        // on la supprime pour la recréer proprement.
        Schema::dropIfExists('necrologies');

        Schema::create('necrologies', function (Blueprint $table) {
            $table->id();
            
            // LIEN AVEC LE PRÊTRE (C'est ce qui manquait)
            // Si le user est supprimé, la nécrologie le sera aussi (cascade)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Infos stockées au moment du décès (Snapshot)
            $table->string('name')->nullable();  // Nom complet
            $table->string('title')->nullable(); // Abbé, Monseigneur...
            
            $table->date('birth_date')->nullable();
            $table->date('death_date'); // Obligatoire
            
            $table->longText('biography')->nullable(); // Texte riche (Quill)
            $table->string('photo_path')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('necrologies');
    }
};