<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_posts_table.php
public function up(): void
{
    Schema::create('posts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // L'auteur (Curé, Secrétaire...)
        $table->foreignId('category_id')->constrained();
        
        $table->string('title');
        $table->string('slug')->unique();
        $table->text('excerpt')->nullable(); // Résumé
        $table->longText('body'); // Contenu complet
        $table->string('image_path')->nullable();
        
        // Workflow de validation
        // 'draft' (brouillon), 'pending' (en attente validation), 'published' (visible), 'rejected'
        $table->string('status')->default('draft'); 
        
        $table->timestamp('published_at')->nullable(); // Date de publication réelle
        $table->boolean('is_featured')->default(false); // À la une sur l'accueil
        
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
