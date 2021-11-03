<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseBab extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'name',
        'order',
        'slug',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function course()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }
}
