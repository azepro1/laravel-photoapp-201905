<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Socialite;
use Illuminate\Http\Request;
use App\Model\User;


class SocialController extends Controller
{
    public function getFacebookAuth() {
        return Socialite::driver('facebook')->redirect();
        }

    public function getFacebookAuthCallback(Request $request) {
        $facebook_user = Socialite::driver('facebook')->user();
        //dd($facebook_user);
        //ToDo: 外側に出してクラス変数にする
        $now = date("Y/m/d H:i:s");
            //ToDo: Facebookのユーザ名をddで確認して、修正する。
            //ToDo: DBのカラム名を変更する。
            $app_user = User::where('github_id', $facebook_user->id)->first();
            if (empty($app_user)) {
                DB::insert('insert into public.users (github_id, comment, created_at, updated_at) values (?, ?, ?, ?)', [$facebook_user->id, 'facebook', $now, $now]);
            }
            $user = User::where('github_id', $facebook_user->id)->first();
            $request->session()->put('user_id', $user->id);
            $request->session()->put('display_name', $user->github_id);            
            return redirect('home');
        }
        
}
