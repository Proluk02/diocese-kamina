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
    Schema::create('parishes', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Ex: Paroisse Saint Joseph
        $table->string('city'); // Ex: Kamina
        $table->string('address')->nullable();
        $table->text('history')->nullable(); // Historique bref
        $table->string('photo_path')->nullable(); // Photo de l'église
        
        // Coordonnées GPS pour la carte
        $table->decimal('latitude', 10, 8)->nullable();
        $table->decimal('longitude', 11, 8)->nullable();
        
        $table->text('mass_schedules')->nullable(); // Horaires des messes (stocké en texte ou JSON)
        $table->string('contact_phone')->nullable();
        
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parishes');
    }
};
