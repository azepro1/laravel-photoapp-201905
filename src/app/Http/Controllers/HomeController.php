<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Post;
use App\Model\Like;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //投稿の一覧を取得
        $posts = Post::orderBy('id', 'desc')->paginate(9);

        //投稿ごとに、ログイン中ユーザがlike済みか取得
        $user_id = $request->session()->get('user_id');
        //dd($posts[0]->id);
        $count = 0;
        foreach ($posts as $post) {
            //like済みの場合、trueを返す
            $liked = !(is_null(Like::where('user_id', $user_id)->where('post_id', $post->id)->first()));
            //配列にキー:likedを追加する
            $posts[$count]['liked'] = $liked;
            ++$count;
        }
        return view('home', ['posts' => $posts, 'request' => $request]);
    }


}
