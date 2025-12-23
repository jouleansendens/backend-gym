<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    protected $table = 'pricing';
    
    protected $fillable = [
        'name', 
        'price', 
        'period', 
        'description', 
        'features', 
        'popular'
    ];
    
    protected $casts = [
        'features' => 'array',
        'popular' => 'boolean'
    ];
}