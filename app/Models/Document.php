<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'file_path',
        'type',             // homelie, lettre, communique
        'is_downloadable',
        'user_id',
    ];

    protected $casts = [
        'is_downloadable' => 'boolean',
    ];

    /* -----------------------------------------------------------------
     |  RELATIONS
     | -----------------------------------------------------------------
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}