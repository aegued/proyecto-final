<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Posts Relationship
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    //Comments Relationship
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //Comparar el rol del usuario
    public function hasRole($role)
    {
        return ($this->role == $role) ? true : false;
    }
}
