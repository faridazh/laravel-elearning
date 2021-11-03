<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'user_id',
        'favs',
        'completed',
    ];

    protected $casts = [
        'favs' => 'boolean',
        'completed' => 'boolean',
    ];

    public function course()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }
}
