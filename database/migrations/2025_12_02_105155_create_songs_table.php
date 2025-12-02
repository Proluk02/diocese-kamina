<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_songs_table.php
public function up(): void
{
    Schema::create('songs', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('composer')->nullable(); // Auteur/Compositeur
        
        $table->string('audio_path')->nullable(); // Fichier MP3
        $table->string('score_path')->nullable(); // Partition (PDF/IMG)
        $table->text('lyrics')->nullable(); // Paroles
        
        // Moment liturgique (Entrée, Offertoire, Communion...)
        $table->string('liturgical_moment')->nullable(); 
        
        $table->foreignId('user_id')->constrained(); // Le musicien qui a posté
        
        // Validation par l'admin
        $table->boolean('is_approved')->default(false); 
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
