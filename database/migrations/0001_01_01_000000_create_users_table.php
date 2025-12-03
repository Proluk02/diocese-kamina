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
        // 1. Table des utilisateurs (Avec vos personnalisations)
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            
            // Rôles : admin (Com), bishop, priest, secretary, musician, user (fidèle)
            $table->string('role')->default('user'); 
            
            // Lien avec une paroisse
            // Note : On ne met pas 'constrained' ici pour éviter les erreurs si la table 'parishes'
            // n'est pas encore créée lors de l'exécution de cette migration.
            $table->foreignId('parish_id')->nullable()->index(); 
            
            $table->string('phone')->nullable(); // Pour contacter le responsable
            $table->boolean('is_active')->default(true); // Pour bloquer un compte si besoin
            
            $table->rememberToken();
            $table->timestamps();
        });

        // 2. Table de réinitialisation de mot de passe (Standard Laravel)
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // 3. Table des sessions (Celle qui causait l'erreur)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};