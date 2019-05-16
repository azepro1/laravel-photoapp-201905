<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Posts;
use Socialite;
use Illuminate\Http\Request;
//６の演習で１行追加
use Illuminate\Support\Facades\DB;

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
    public function upload(Request $request)
    {
        $this->validate($request, [
            'file' => [
                // 必須
                'required',
                // アップロードされたファイルであること
                'file',
                // 画像ファイルであること
                'image',
                // MIMEタイプを指定
                'mimes:jpeg,png',
            ],
            'caption' => [
                // 必須
                'required'
            ]

        ]);

        //git-hubのnickname取得
        //ToDo: GithubControllerでも同じものを取得してしまっている（冗長）。
        $token = session()->get('github_token');
        $github_user = Socialite::driver('github')->userFromToken($token);
        $nickname = $github_user->nickname;

        if (($request->file('file')->isValid([]))&&(true)) {
            $path = $request->file->store('public');
            $caption = $request->caption;
            //６の演習で２行追加
            $now = date("Y/m/d H:i:s");
            DB::insert('insert into public.posts (name, nickname, caption, path, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', ['filename', $nickname, $caption, basename($path), $now, $now]);
            //６の演習で１行コメントアウト
            //return view('home')->with('filename', basename($path));
            //６の演習で２行追加
            //$sql_result = DB::select('select * from public.image');
            //return view('home')->with('sql_result', $sql_result);
            $posts = DB::table('posts')->get();
            return view('home', ['posts' => $posts]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors();
        }
    }

    /**
     * 投稿削除処理
     */

    public function destroy($id)
    {
        #削除処理
        $post = Posts::findOrFail($id);
        $post->delete();
        
        #ホーム画面にリダイレクト
        return redirect('/home');
        }

}
