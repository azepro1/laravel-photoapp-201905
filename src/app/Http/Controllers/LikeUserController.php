<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Model\Like;
use App\Model\Post;

class LikeUserController extends Controller
{
    public function index($post_id)
    {
        //postに紐付く、likeした人(github_id)の一覧を取得する
        $like_users = Like::join('users', 'likes.user_id', '=', 'users.id')
                                ->select('users.github_id')
                                ->where('likes.post_id', $post_id)
                                ->get();
        //ToDo: ユーザごとにGithubアイコンを取得する。

        return view('likeuser', ['like_users' => $like_users]);
    }
}