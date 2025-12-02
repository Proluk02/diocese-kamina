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
        'history',
        'photo_path',
        'latitude',
        'longitude',
        'mass_schedules', // Stocké en JSON
        'contact_phone',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'mass_schedules' => 'array', // Conversion automatique JSON <-> Array
    ];

    /* -----------------------------------------------------------------
     |  RELATIONS
     | -----------------------------------------------------------------
     */

    // Une paroisse a plusieurs membres du clergé ou secrétaires
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}