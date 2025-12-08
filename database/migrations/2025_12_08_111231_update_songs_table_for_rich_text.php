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
        $table->longText('lyrics')->nullable()->change(); // Pour l'éditeur Quill
        // On s'assure que ces colonnes existent
        if (!Schema::hasColumn('songs', 'audio_path')) $table->string('audio_path')->nullable();
        if (!Schema::hasColumn('songs', 'score_path')) $table->string('score_path')->nullable();
    });
}
    public function down(): void
    {
        //
    }
};
