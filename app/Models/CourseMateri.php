<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseMateri extends Model
{
    use HasFactory;

    protected $fillable = [
        'bab_id',
        'name',
        'order',
        'content',
        'files',
        'slug',
    ];

    protected $casts = [
        'files' => 'array'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function bab()
    {
        return $this->hasOne(CourseBab::class, 'id', 'bab_id');
    }
}
