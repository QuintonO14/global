<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;


class FriendController extends Controller
{
    public function getAdd($id) {

        $user = User::where('id', $id)->first();
        if (!$user) {
            return redirect('dashboard')->with('info', 'That User Could Not Be Found');
        }

        if (Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())){
            return redirect()->back()->with('info', 'Your Friend Request Is Pending');
        }
        Auth::user()->addFriend($user);

        return redirect()->back()->with('info', 'Friend Request Sent!');
    }

    public function getAccept($id) {

        $user = User::where('id', $id)->first();

        Auth::user()->acceptFriendRequest($user);

        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);;
    }

    public function getDecline($id) {

        $user = User::where('id', $id)->first();

        Auth::user()->deleteFriendRequest($user);

        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);;
    }

    public function deleteFriend($id) {

        $user = User::where('id', $id)->first();

        Auth::user()->deleteFriend($user);

        return redirect('/dashboard');
    }

}
