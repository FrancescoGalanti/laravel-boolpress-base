<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class Post extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'slug',
        'path_img'
    ];


    // posts - info_posts
    public function infoPost(){
        return $this->hasone('App\infoPost');
    }

    // posts - comments

    public function comments(){
        return $this->hasmany('App\Comment');
    }
}
