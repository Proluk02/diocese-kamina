<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne; 

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',  
        'avatar',     
        'role',
        'is_active',
        'phone',
        'parish_id',
        'profile_photo_path',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }
    public function parish(): BelongsTo
    {
        return $this->belongsTo(Parish::class);
    }
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
    public function songs(): HasMany
    {
        return $this->hasMany(Song::class);
    }
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
    public function necrology(): HasOne
    {
        return $this->hasOne(Necrology::class);
    }
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }
    public function isAdmin(): bool
    {
        return in_array($this->role, ['admin', 'bishop']);
    }
    public function isStaff(): bool
    {
        return in_array($this->role, ['admin', 'bishop', 'priest', 'secretary']);
    }
}