<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $users = User::where('id', '!=', Auth::id())->simplePaginate(5);
        $posts = Post::where("dash_id", '=', $user->id)->latest()->paginate(3);
        $photos = Photo::where('user_id', '=', $user->id)->latest()->paginate(6);
        $friends = Auth::user()->friends();
        $requests =  Auth::user()->friendRequests();


        return view('main.index', compact('posts', 'user', 'users', 'photos', 'friends', 'requests', 'comments'));


    }
}
