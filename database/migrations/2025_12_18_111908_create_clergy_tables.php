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
        // 1. Historique des affectations
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Le Prêtre
            $table->foreignId('parish_id')->nullable()->constrained()->onDelete('set null'); // La Paroisse
            $table->string('function'); // Ex: Curé, Vicaire, Aumônier
            $table->date('start_date');
            $table->date('end_date')->nullable(); // Null = En cours
            $table->boolean('is_current')->default(true);
            $table->timestamps();
        });

        // 2. Nécrologie (Prêtres/Religieux décédés)
        Schema::create('necrologies', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nom complet
            $table->string('title'); // Abbé, Monseigneur, Sœur...
            $table->date('birth_date')->nullable();
            $table->date('death_date');
            $table->text('biography')->nullable(); // Rich Text
            $table->string('photo_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clergy_tables');
    }
};
