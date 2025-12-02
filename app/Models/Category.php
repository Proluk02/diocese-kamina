<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'color', // ex: 'blue', 'red', 'gold' pour l'affichage CSS
    ];

    /* -----------------------------------------------------------------
     |  RELATIONS
     | -----------------------------------------------------------------
     */

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}