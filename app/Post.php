<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Sluggable, SluggableScopeHelpers;

    //The attributes that are mass assignable.
    protected $fillable = ['title','content','user_id', 'image_url', 'slug'];

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

    //Return the sluggable configuration array for this model.
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
