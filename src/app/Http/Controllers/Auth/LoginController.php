<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller,
    Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * ログイン
     *
     * @return \Illuminate\Http\Response
     */
    public function loginConfirm()
    {
        return view('login'); 
    }

    /**
     * ログアウト
     */
    public function logout()
    {
        Session::flush();
        return redirect('/login')->with('success', 'Logged out successfully');
    }
}
