<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Song extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'composer', 
        'composer_description', // Nouveau
        'audio_path', 
        'score_path',
        'lyrics',
        'liturgical_moment', 
        'liturgical_season',    // Nouveau
        'theme',                // Nouveau
        'user_id', 
        'is_approved',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    // CONSTANTES POUR LES LISTES DÉROULANTES
    public const MOMENTS = [
        'Entrée', 'Antienne d\'ouverture', 'Kyrie', 'Gloria', 
        'Psaume', 'Acclamation', 'Prière Universelle', 'Credo',
        'Offertoire', 'Sanctus', 'Agnus Dei', 'Communion', 
        'Action de grâce', 'Envoi', 'Méditation', 'Procession'
    ];

    public const SEASONS = [
        'Temps Ordinaire', 'Avent', 'Noël', 'Carême', 
        'Semaine Sainte', 'Pâques', 'Ascension', 'Pentecôte'
    ];

    public const THEMES = [
        'Vierge Marie', 'Saints & Martyrs', 'Sacré-Cœur', 'Esprit Saint',
        'Adoration', 'Louange', 'Mariage', 'Funérailles', 
        'Vocation', 'Paix & Justice'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeApproved(Builder $query): void
    {
        $query->where('is_approved', true);
    }
}