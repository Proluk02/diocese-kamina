<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Necrology extends Model
{
    protected $fillable = [
        'user_id', // Le lien
        'name',    // On garde le nom en dur pour l'historique
        'title',   
        'birth_date', 
        'death_date', 
        'biography', 
        'photo_path'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'death_date' => 'date'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}