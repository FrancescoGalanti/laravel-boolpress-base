<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


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
        return $this->hasOne('App\InfoPost');
    }

    // posts - comments

    public function comments(){
        return $this->hasMany('App\Comment');
    }
}
