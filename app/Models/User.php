<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Les attributs assignables en masse.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',          // admin, bishop, priest, secretary, musician, user
        'parish_id',     // ID de la paroisse (optionnel)
        'phone',
        'is_active',
    ];

    /**
     * Les attributs cachés pour la sérialisation.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Les conversions de types.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /* -----------------------------------------------------------------
     |  RELATIONS
     | -----------------------------------------------------------------
     */

    // Un utilisateur peut appartenir à une paroisse (ex: un Curé)
    public function parish(): BelongsTo
    {
        return $this->belongsTo(Parish::class);
    }

    // Un utilisateur peut écrire plusieurs articles
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    // Un musicien peut proposer plusieurs chants
    public function songs(): HasMany
    {
        return $this->hasMany(Song::class);
    }

    // Un utilisateur peut uploader des documents
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    /* -----------------------------------------------------------------
     |  HELPERS (Vérification des Rôles)
     | -----------------------------------------------------------------
     */

    // Vérifie si l'utilisateur a un rôle spécifique
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    // Vérifie si l'utilisateur est Admin ou Évêque (Super pouvoirs)
    public function isAdmin(): bool
    {
        return in_array($this->role, ['admin', 'bishop']);
    }

    // Vérifie si l'utilisateur fait partie du staff (Curé, Secrétaire, Admin...)
    public function isStaff(): bool
    {
        return in_array($this->role, ['admin', 'bishop', 'priest', 'secretary']);
    }
}