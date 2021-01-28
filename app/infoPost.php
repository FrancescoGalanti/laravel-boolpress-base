<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class infoPost extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    // info_posts - posts

    public function post(){
        return $this->belongsTo('App\Post');
    }
}
