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
        'audio_path',
        'score_path',       // Partition
        'lyrics',
        'liturgical_moment', // Entrée, Kyrie, Gloria...
        'user_id',
        'is_approved',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    /* -----------------------------------------------------------------
     |  RELATIONS
     | -----------------------------------------------------------------
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /* -----------------------------------------------------------------
     |  SCOPES
     | -----------------------------------------------------------------
     */

    // Pour afficher uniquement les chants validés sur le site public
    public function scopeApproved(Builder $query): void
    {
        $query->where('is_approved', true);
    }
}