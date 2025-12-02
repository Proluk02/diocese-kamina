<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'excerpt',
        'body',
        'image_path',
        'status',       // 'draft', 'pending', 'published', 'rejected'
        'published_at',
        'is_featured',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
    ];

    /* -----------------------------------------------------------------
     |  RELATIONS
     | -----------------------------------------------------------------
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /* -----------------------------------------------------------------
     |  SCOPES (Filtres pour les requêtes)
     | -----------------------------------------------------------------
     */

    // Utilisation : Post::published()->get();
    public function scopePublished(Builder $query): void
    {
        $query->where('status', 'published')
              ->where('published_at', '<=', now());
    }

    // Utilisation : Post::featured()->get();
    public function scopeFeatured(Builder $query): void
    {
        $query->where('is_featured', true);
    }
    
    // Utilisation : Post::pending()->get(); (Pour l'admin qui doit valider)
    public function scopePending(Builder $query): void
    {
        $query->where('status', 'pending');
    }
}