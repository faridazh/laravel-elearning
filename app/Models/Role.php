<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'primary',          // 0 || 1 (true || false) == primary or secondary
        'premium',
        'bg_color',
        'text_color',
        'icon',
        'candelete',
    ];

    protected $casts = [
        'primary' => 'boolean',
        'premium' => 'boolean',
        'candelete' => 'boolean',
    ];
}
