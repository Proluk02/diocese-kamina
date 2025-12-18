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
        Schema::table('songs', function (Blueprint $table) {
            // Ajout des nouveaux champs si ils n'existent pas
            if (!Schema::hasColumn('songs', 'liturgical_season')) {
                $table->string('liturgical_season')->nullable(); // Avent, Noël...
            }
            if (!Schema::hasColumn('songs', 'theme')) {
                $table->string('theme')->nullable(); // Marie, Adoration...
            }
            if (!Schema::hasColumn('songs', 'composer_description')) {
                $table->text('composer_description')->nullable(); // Bio
            }
            
            // On s'assure que lyrics est en longText pour le Rich Text
            $table->longText('lyrics')->nullable()->change();
            
            // Indexation pour la recherche rapide
            $table->index(['title', 'composer', 'liturgical_moment']);
        });
    }

    public function down(): void
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->dropColumn(['liturgical_season', 'theme', 'composer_description']);
        });
    }
};