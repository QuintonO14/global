<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use SoftDeletes;
    protected $table = 'likeables';
    protected $fillable = [
        'user_id',
        'likeable_id',
        'likeable_type',
        ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function posts()
    {
        $this->morphedByMany('App\Post', 'likeable');
    }
}

