<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function createComment(Request $request)
    {

        $user = Auth::user();

        $comment = [

            'post_id' => $request->post_id,
            'user_id'=> $user->id,
            'body'=>$request->body
        ];

        Comment::create($comment);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        $comment->delete();

        return redirect('/dashboard');
    }
}
