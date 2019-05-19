<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;// 追加！
use Illuminate\Http\Request;// 追加！
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
     * login画面への遷移 updated on 2019.05.08
     *
     * @return \Illuminate\Http\Response
     */
    public function loginConfirm()// 追加！
    {
        return view('login'); 
    }

    /**
     * GitHubの認証ページヘユーザーをリダイレクト
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()// 追加！
    {
        return Socialite::driver('github')->scopes(['read:user', 'public_repo'])->redirect(); 
    }

    /**
     * GitHubからユーザー情報を取得
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request)
    {
        $github_user = Socialite::driver('github')->user();


        $now = date("Y/m/d H:i:s");
        $app_user = DB::select('select * from public.users where github_id = ?', [$github_user->user['login']]);
        if (empty($app_user)) {
            DB::insert('insert into public.users (github_id, created_at, updated_at) values (?, ?, ?)', [$github_user->user['login'], $now, $now]);
        }

        $user = DB::table('users')->where('github_id', $github_user->nickname)->first();
        $user_id = $user->id;
        $request->session()->put('user_id', $user_id);
        $request->session()->put('github_token', $github_user->token);

        return redirect('github');
    }
}
