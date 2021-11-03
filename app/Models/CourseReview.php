<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'author_id',
        'user_id',
        'stars',
        'review',
        'hidename',
    ];

    protected $casts = [
        'hidename' => 'boolean',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function course()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }
}
