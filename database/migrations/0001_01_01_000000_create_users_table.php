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
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        
        // Rôles : admin (Com), bishop, priest, secretary, musician, user (fidèle)
        $table->string('role')->default('user'); 
        
        // Lien avec une paroisse (Facultatif, car l'évêque ou l'admin n'ont pas de paroisse spécifique)
        // On utilisera une clé étrangère plus tard après la création de la table parishes, 
        // ou on l'ajoute maintenant en "unsignedBigInteger" nullable.
        $table->foreignId('parish_id')->nullable()->index(); 
        
        $table->string('phone')->nullable(); // Pour contacter le responsable
        $table->boolean('is_active')->default(true); // Pour bloquer un compte si besoin
        
        $table->rememberToken();
        $table->timestamps();
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
