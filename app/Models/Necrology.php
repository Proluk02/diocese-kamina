<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Necrology extends Model {
    protected $fillable = ['name', 'title', 'birth_date', 'death_date', 'biography', 'photo_path'];
    protected $casts = ['birth_date' => 'date', 'death_date' => 'date'];
}