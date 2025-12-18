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
    Schema::table('necrologies', function (Blueprint $table) {
        // On lie au prêtre existant
        $table->foreignId('user_id')->after('id')->constrained()->onDelete('cascade');
        
        // On rend name/title nullables car on les prendra du User, 
        // ou on les garde pour l'historique (snapshot)
        $table->string('name')->nullable()->change(); 
        $table->string('title')->nullable()->change();
    });
}

public function down(): void
{
    Schema::table('necrologies', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
    });
}
};
