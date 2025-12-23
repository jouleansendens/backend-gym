<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name', 
        'role', 
        'image', 
        'rating', 
        'text', 
        'is_active'
    ];
    
    protected $casts = [
        'rating' => 'integer',
        'is_active' => 'boolean',
    ];
}