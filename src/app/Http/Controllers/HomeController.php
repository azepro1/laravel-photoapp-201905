<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Post;
use App\Model\Like;
use App\Model\User;

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
        $posts = Post::orderBy('id', 'desc')->paginate(12);

        $user_id = $request->session()->get('user_id');
        $count = 0;
        foreach ($posts as $post) {
            //投稿ごとに、ログイン中ユーザがlike済みか取得
            //like済みの場合、trueを返す
            $liked = !(is_null(Like::where('user_id', $user_id)->where('post_id', $post->id)->first()));
            //配列にキー:likedを追加する
            $posts[$count]['liked'] = $liked;
    
            //投稿ごとのlike数を取得
            $like_count = Post::join('likes', 'posts.id', '=', 'likes.post_id')
            ->select('likes.user_id')
            ->where('post_id', $post->id)
            ->count();
            //配列にキー:like_countを追加する
            $posts[$count]['like_count'] = $like_count;
    
            ++$count;
        }

        //ログインユーザを取得
        $login_user = User::where('id', $user_id)->first();

        return view('home', ['posts' => $posts, 'request' => $request, 'login_user' => $login_user]);
    }


}
