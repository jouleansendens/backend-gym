<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'goal',
        'message',
        'is_read'
    ];
    
    protected $casts = [
        'is_read' => 'boolean',
    ];
}