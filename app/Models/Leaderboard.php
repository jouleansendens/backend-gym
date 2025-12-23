<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leaderboard extends Model
{
    protected $table = 'leaderboard';
    
    protected $fillable = ['name', 'steps'];
    
    protected $casts = [
        'steps' => 'integer',
    ];
}