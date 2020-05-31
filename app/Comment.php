<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //The attributes that are mass assignable.
    protected $fillable = ['text','user_id','post_id'];

    protected $appends = ['createdDate'];

    //User Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Post Relationship
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
