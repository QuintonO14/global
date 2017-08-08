<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $uploads = '/images/';


    protected $fillable = ['path', 'user_id'];

    public function getPathAttribute($photo){

        return $this->uploads . $photo;
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id');
    }

    public function post()
    {
        return $this->belongsTo('App\Post','photo_id');
    }



}
