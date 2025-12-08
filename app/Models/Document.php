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
    'type',
    'file_path',
    'is_downloadable',
    'user_id',
    'description', // <--- CELLE-CI DOIT ÊTRE LÀ
    'video_link',  // <--- CELLE-CI AUSSI
];

    protected $casts = [
        'is_downloadable' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}