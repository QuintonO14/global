<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', function () {

    $countries = \App\Country::all()->pluck('name');

return view('welcome', compact('countries'));
});

Route::resource('/user', 'UserController');

Route::put('/user/cover/{id}', [
    'uses' => 'UserController@updateCover',
    'as' => 'update.cover',
    'middleware' => 'auth'
]);

Route::patch('/user/cover/{id}', [
    'uses' => 'UserController@updateStatus',
    'as' => 'status.update',
    'middleware' => 'auth'
]);

Route::put('/user/profile/{id}', [
    'uses' => 'UserController@updateProfilePic',
    'as' => 'change.profile',
    'middleware' => 'auth'
]);

Route::resource('/post', 'PostController');

Route::post('/post/friend', [
    'uses' => 'PostController@friendPostStore',
    'as' => 'friend.post',
    'middleware' => 'auth'
]);

Route::get('post/like/{id}', [
    'as' => 'post.like',
    'uses' => 'PostController@likePost',
    'middleware' => 'auth'
]);

Route::resource('/photo', 'PhotoController');


Route::get('/dashboard/', [
    'uses' => 'HomeController@index',
    'as' => 'dashboard',
    'middleware' => 'auth']
);

Route::get('/dashboard/add/{id}', [
   'uses' => 'FriendController@getAdd',
    'as' => 'friend.add',
    'middleware' => ['auth'],
]);

Route::get('/dashboard/accept/{id}', [
    'uses' => 'FriendController@getAccept',
    'as' => 'friend.accept',
    'middleware' => ['auth'],
]);

Route::get('/dashboard/decline/{id}', [
    'uses' => 'FriendController@getDecline',
    'as' => 'friend.decline',
    'middleware' => ['auth'],
]);

Route::get('/dashboard/delete/{id}', [
    'uses' => 'FriendController@deleteFriend',
    'as' => 'friend.delete',
    'middleware' => ['auth'],
]);

Route::post('/comment',[
    'uses'=>'CommentController@createComment',
    'as'=>'comment',
    'middleware' => 'auth'
]);

Route::delete('/deletecomment/{id}',[
    'uses'=>'CommentController@destroy',
    'as'=>'deletecomment',
    'middleware' => 'auth'
]);

Route::get('/dashboard/{id}', [
    'uses' => 'UserController@getProfile',
    'as' => 'profile.index',
    'middleware' => 'auth'
]);

Route::get('search/autocomplete', [
    'uses' => 'UserController@autocomplete',
    'as' => 'autocomplete'
]);

Route::get('/logout', 'Auth\LoginController@logout');

