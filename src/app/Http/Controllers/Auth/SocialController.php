<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Socialite;
use Illuminate\Http\Request;
use App\Model\User;


class SocialController extends Controller
{
    /**
     * Facebookログイン
     */
    public function getFacebookAuth() {
        return Socialite::driver('facebook')->redirect();
        }

    public function getFacebookAuthCallback(Request $request) {
        $facebook_user = Socialite::driver('facebook')->user();
        $now = date("Y/m/d H:i:s");
        $app_user = User::where('social_id', $facebook_user->id)->first();
        if (empty($app_user)) {
            DB::insert('insert into public.users (social_id, social, image_path, created_at, updated_at) values (?, ?, ?, ?, ?)', [$facebook_user->id, 'facebook', $facebook_user->avatar, $now, $now]);
        }
        $user = User::where('social_id', $facebook_user->id)->first();
        $request->session()->put('user_id', $user->id);
        $request->session()->put('display_name', $user->social_id);            
        return redirect('/');
    }
    
    /**
     * Githubログイン
     */
    public function getGithubAuth() {
        return Socialite::driver('github')->redirect();
        }

    public function getGithubAuthCallback(Request $request) {
        $github_user = Socialite::driver('github')->user();
        $now = date("Y/m/d H:i:s");
        $image_path = "https://avatars.githubusercontent.com/" . $github_user->nickname;
        $app_user = User::where('social_id', $github_user->nickname)->first();
        if (empty($app_user)) {
            DB::insert('insert into public.users (social_id, social, image_path, created_at, updated_at) values (?, ?, ?, ?, ?)', [$github_user->nickname, 'github', $image_path, $now, $now]);
        }
        $user = User::where('social_id', $github_user->nickname)->first();
        $request->session()->put('user_id', $user->id);
        $request->session()->put('display_name', $user->social_id);            
        return redirect('/');
    }

        
}
