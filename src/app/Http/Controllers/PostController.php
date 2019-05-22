<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Post;
use Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post');
    }

    /**
     * ファイルアップロード処理
     */
    public function upload(PostRequest $request)
    {
        //git-hubのnickname取得
        //ToDo: GithubControllerでも同じものを取得してしまっている（冗長）。
        $token = session()->get('github_token');
        $github_user = Socialite::driver('github')->userFromToken($token);
        $nickname = $github_user->nickname;
        $user_id = DB::table('users')->where('github_id', $nickname)->first()->id;

        if (($request->file('photo')->isValid([]))&&(true)) {
            $path = $request->photo->store('public');
            $caption = $request->caption;
            $now = date("Y/m/d H:i:s");
            DB::insert('insert into public.posts (path, caption, user_id, nickname, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', [basename($path), $caption, $user_id, $nickname, $now, $now]);
            return redirect('home')
                ->with('success', '新しい投稿をしました');
        }/* else {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors();
        }*/
    }

    /**
     * 投稿削除処理
     */
    public function destroy($id)
    {
        #削除処理
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect('/home');
        }

}
