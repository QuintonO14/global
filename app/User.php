<?php

namespace App;

use Arubacao\Friends\Traits\Friendable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */

    protected $table = 'users';
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'country_living',
        'country_from',
        'job',
        'gender',
        'photo_id',
        'cover_id',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function role()
    {

        return $this->belongsTo('App\Role');

    }

    public function country() {
        return $this->hasOne('App\Country');
    }

    public function photo()
    {

        return $this->belongsTo('App\Photo');

    }

    public function photos()
    {
        return $this->hasMany('App\Photo');
    }

    public function likedposts()
    {
        return $this->morphedByMany('App\Post', 'likeable')->whereDeletedAt(null);
    }

    public function posts()
    {

        return $this->hasMany('App\Post');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function cover()
    {
        return $this->belongsTo('App\Photo');
    }


    public function friendsOfMine() {
        return $this->belongsToMany('App\User', 'friends', 'user_id','friend_id');
    }

    public function friendOf() {
        return $this->belongsToMany('App\User', 'friends','friend_id','user_id');
    }

    public function friends() {
        return $this->friendsOfMine()->wherePivot('accepted',true)->get()->merge($this->friendOf()->where('accepted', true)->get());
    }

    public function friendRequests(){
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

    public function friendRequestsPending(){
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }

    public function hasFriendRequestPending(User $user) {

        return (bool) $this->friendRequestsPending()->where('id', $user->id)->count();
    }

    public function hasFriendRequestReceived(User $user){
        return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }

    public function addFriend(User $user) {
        $this->friendOf()->attach($user->id);
    }

    public function acceptFriendRequest(User $user)
    {
        $this->friendRequests()->where('id', $user->id)->first()->pivot->update(['accepted'=> true]);
    }

    public function deleteFriendRequest(User $user)
    {
        $this->friendRequests()->where('id', $user->id)->first()->pivot->delete(['id']);
    }

    public function deleteFriend(User $user)
    {
        $this->friends()->where('id', $user->id)->first()->pivot->delete(['id']);
    }


    public function isFriendsWith(User $user) {

        return $this->friends()->where('id', $user->id)->count();
    }



}

