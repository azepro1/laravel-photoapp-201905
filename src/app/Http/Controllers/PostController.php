<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Post;
use Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PostRequest;
use Aws\S3\S3Client;

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
        $nickname = $request->session()->get('display_name');
        $user_id = DB::table('users')->where('social_id', $nickname)->first()->id;

        if (($request->file('photo')->isValid([]))&&(true)) {
            //$path = $request->photo->store('public');

            //S3clientのインスタンス生成
            $s3client = S3Client::factory([
                'credentials' => [
                    'key' => env('AWS_ACCESS_KEY_ID'),
                    'secret' => env('AWS_SECRET_ACCESS_KEY'),
                ],
                'region' => 'ap-southeast-1',
                'version' => 'latest',
            ]);
            //AWS S3のバケット名を指定
            $bucket = getenv('S3_BUCKET_NAME');
            //Resource型でファイルの中身を指定
            $image = fopen($_FILES['photo']['tmp_name'],'rb');
            //ファイル名を生成
            $filename = date('YmdHms_').$_FILES['photo']['name'];

            //画像のアップロード
            $result = $s3client->putObject([
                'ACL' => 'public-read',
                'Bucket' => $bucket,
                'Key' => $filename,
                'Body' => $image,
                'ContentType' => mime_content_type($_FILES['photo']['tmp_name']),
            ]);
            //画像のパスを返す
            $path = $result['ObjectURL'];

            //投稿の情報をDBへインサート
            $caption = $request->caption;
            $now = date("Y/m/d H:i:s");
            DB::insert('insert into public.posts (path, caption, user_id, nickname, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', [$path, $caption, $user_id, $nickname, $now, $now]);
            return redirect('/')
                ->with('success', 'Posted successfully!');
        }
    }

    /**
     * 投稿削除処理
     */
    public function destroy($id)
    {
        #削除処理
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect('/');
        }

}
