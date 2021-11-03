<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumReply extends Model
{
    protected $fillable = [
        'thread_id',
        'author_id',
        'content',
    ];

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function thread()
    {
        return $this->hasOne(ForumThread::class, 'id', 'thread_id');
    }
}
