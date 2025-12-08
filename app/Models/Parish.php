<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Parish extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city',
        'address',
        'history',          // Rich Text
        'photo_path',
        'latitude',
        'longitude',
        'mass_schedules',   // Rich Text
        'contact_phone',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}