<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Socialite;
use Illuminate\Http\Request;


class SocialController extends Controller
{
    public function getFacebookAuth() {
        return Socialite::driver('facebook')->redirect();
        }

    public function getFacebookAuthCallback() {
        $facebook_user = Socialite::driver('facebook')->user();
        //dd($facebook_user);
        //ToDo: 外側に出してクラス変数にする
        $now = date("Y/m/d H:i:s");
            //ToDo: Facebookのユーザ名をddで確認して、修正する。
            //ToDo: DBのカラム名を変更する。
            $app_user = DB::select('select * from public.users where github_id = ?', $facebook_user->id);
            if (empty($app_user)) {
                DB::insert('insert into public.users (github_id, created_at, updated_at) values (?, ?, ?)', [$facebook_user->id, $now, $now]);
            }
            $user = DB::table('users')->where('github_id', $facebook_user->id)->first();
            $user_id = $user->id;
            $request->session()->put('user_id', $user_id);
            
            return redirect('home');
        }
        
}
