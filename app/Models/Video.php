<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'name',
        'meta_keywords',
        'meta_des',
        'des',
        'youtube',
        'published',
        'user_id',
        'cat_id',
        'image'
    ];

    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }

    public function cat(){
        return $this->belongsTo(Category::class , 'cat_id');
    }

    public function skills(){
        return $this->belongsToMany(Skill::class , 'skills_videos');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class , 'tags_videos');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function scopePublished(){
        return $this->where('published' , 1);
    }
}
