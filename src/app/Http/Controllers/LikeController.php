<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Model\Like;
use App\Model\Post;

class LikeController extends Controller
{
    public function store(Request $request, $post_id) {
        $user_id = $request->session()->get('user_id');
        Like::firstOrCreate(
          array(
            'user_id' => $user_id,
            'post_id' => $post_id
          )
        );

        $post = Post::findOrFail($post_id);

        return redirect()
             ->action('HomeController@index', $post->id);
    }

    public function destroy(Request $request, $post_id) {
      $user_id = $request->session()->get('user_id');
      $like = Like::where('post_id', $post_id)->where('user_id', $user_id)->first();
      Like::findOrFail($like->id)->delete();

      return redirect('/home');
    }
}