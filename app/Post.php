<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //The attributes that are mass assignable.
    protected $fillable = ['title','content','user_id'];

    //User Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Comments Relationship
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
