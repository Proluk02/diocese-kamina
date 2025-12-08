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
    Schema::table('parishes', function (Blueprint $table) {
        // On change en texte long pour accepter le HTML de l'éditeur
        $table->longText('mass_schedules')->nullable()->change();
        // On s'assure que l'historique est aussi en texte long
        $table->longText('history')->nullable()->change();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parishes', function (Blueprint $table) {
            //
        });
    }
};
