<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_xx_xx_create_documents_table.php
public function up(): void
{
    Schema::create('documents', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description')->nullable();
        $table->string('file_path'); // Lien vers le PDF
        $table->string('type'); // 'homelie', 'lettre_pastorale', 'rapport'
        
        // Autorisation de téléchargement (selon cahier des charges)
        $table->boolean('is_downloadable')->default(true);
        
        $table->foreignId('user_id')->constrained(); // Qui a posté
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
