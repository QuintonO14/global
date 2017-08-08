<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void

     */

    public function login(Request $request)
    {
        if (Auth::attempt(array('email' => $request->input('email'), 'password' => $request->input('password')))) {
            session(['email' => $request->input('email')]);
            return redirect('/dashboard');
        } else {
            Session::flash('login-message', "Invalid Email or Password , Please try again.");
            return Redirect::back();
        }
    }



    public function logout() {
        Session::flush ();
        Auth::logout ();
        return Redirect::back ();
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
