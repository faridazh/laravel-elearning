<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumThread extends Model
{
    protected $fillable = [
        'course_id',
        'materi_id',
        'author_id',
        'name',
        'slug',
        'content',
        'replies',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function course()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }

    public function materi()
    {
        return $this->hasOne(CourseMateri::class, 'id', 'materi_id');
    }

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function balasan()
    {
        return $this->hasMany(ForumReply::class, 'thread_id', 'id');
    }
}
