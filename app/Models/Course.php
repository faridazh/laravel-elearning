<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'category_id',
        'author_id',
        'premium',
        'likes',
        'reads',
    ];

    protected $casts = [
        'premium' => 'boolean',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function daftar()
    {
        return $this->hasMany(DaftarCourse::class, 'course_id', 'id');
    }
}
