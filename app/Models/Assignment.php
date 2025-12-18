<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model {
    protected $fillable = ['user_id', 'parish_id', 'function', 'start_date', 'end_date', 'is_current'];
    protected $casts = ['start_date' => 'date', 'end_date' => 'date', 'is_current' => 'boolean'];
    
    public function parish() { return $this->belongsTo(Parish::class); }
    public function user() { return $this->belongsTo(User::class); }
}