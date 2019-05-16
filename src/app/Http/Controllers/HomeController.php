<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
//６の演習で１行追加
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //６の演習で１行コメントアウト
        //return view('home');
        //６の演習で２行追加
        //dd(session('nickname'));
        $nickname = session('nickname');
        $posts = DB::table('posts')->get();
        return view('home', ['posts' => $posts, 'nickname' => $nickname]);
    }


}
