<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    protected $fillable = ['user_id', 'body', 'photo_id','dash_id'];
    public function user() {

        return $this->belongsTo('App\User');
    }

    public function photo(){

        return $this->belongsTo('App\Photo','id');

    }

    public function likes()
    {
        return $this->morphToMany('App\User', 'likeable')->whereDeletedAt(null);    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function getIsLikedAttribute()
    {
        $like = $this->likes()->whereUserId(Auth::id())->first();
        return (!is_null($like)) ? true : false;
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function($posts) {
            $posts->photo()->delete();

        });
    }

}
