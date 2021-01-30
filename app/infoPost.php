<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class InfoPost extends Model
{   

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id',
        'post_status',
        'comment_status',
    ];

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
