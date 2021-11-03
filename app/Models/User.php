<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role_id',
        'avatar',
        'cover',
        'about',
        'birthday',
        'gender',
        'agree_term',
        'agree_service',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'agree_term' => 'boolean',
        'agree_service' => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }
}
