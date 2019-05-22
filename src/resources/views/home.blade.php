@extends('template')
@extends('navbar')
@section('title', 'ホーム画面')
@section('head')
    @section('navbar')
        @parent
    @show
@endsection
@section('content')

    <!-- 画像投稿成功時のメッセージ。 -->
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- temp. ログインしてる？ -->
    @if(Session::get('user_id'))
        {{ 'logged_in user:' }} {{ Session::get('user_id') }}
    @else
        {{ 'ログインしてない' }}
    @endif
    <hr>

    <!-- 画像一覧表示 -->
    <div class="row">
        @foreach ($posts as $post)
            <div class="col-md-4 m-0 p-1">
                <div class="card">
                    <!-- 画像の表示 -->
                    <?php $path = 'storage/' . $post->path; ?>
                    <img class= "card-img-top img-fluid rounded" src="{{ asset($path) }}">

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <!-- キャプションの表示 -->
                                {{ $post->caption }}
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col">
                                <!-- いいねボタンの表示 -->
                                <!-- if:ログイン済みの場合 -->
                                @if(Session::get('user_id'))
                                    <!-- if:Like済みの場合 -->
                                    @if($post->liked)
                                        <form action="{{ action('LikeController@destroy', $post->id) }}" method="post">
                                            {{ csrf_field() }}
                                            <input type="image" src="images/favorited_button.jpeg" width="30"> {{ 'Un-Like' }}
                                            <?php $request->session()->put('user_id', Session::get('user_id')); ?>
                                        </form>
                                    <!-- if:Likeしてない場合 -->
                                    @else
                                        <form action="{{ action('LikeController@store', $post->id) }}" method="post">
                                            {{ csrf_field() }}
                                            <input type="image" src="images/favorite_button.jpeg" width="30"> {{ 'Like！' }}
                                            <?php $request->session()->put('user_id', Session::get('user_id')); ?>
                                        </form>
                                    @endif
                                <!-- else:ログインしてない場合：ボタン非アクティブ -->
                                @else
                                    <input type="image" src="images/favorited_button.jpeg" width="30">
                                @endif
                            </div>
                            <div class="col">
                                <!-- 投稿ユーザとログインユーザが同じ場合に削除ボタンを表示 -->
                                @if($post->user_id === Session::get('user_id'))
                                    <form action="{{ action('PostController@destroy', $post->id) }}" id="form_{{ $post->id }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <button class="btn btn-outline-secondary btn-sm"> 削除 </button>
                                    </form>
                                @else
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <!-- いいねしたユーザ一覧への遷移 -->
                            <div class="col">
                                <a>liked by:</a>
                                <a href="{{ action('LikeUserController@index', $post->id) }}">Likeした人</a>
                            </div>

                            <!-- ニックネームの表示 -->
                            <div class="col">
                                <a>posted by:</a>
                                <a href="{{ action('ProfileController@index', $post->user_id) }}">{{ $post->nickname }}</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <ul class="pagination justify-content-center" style="margin:20px 0">
        {{ $posts->links() }}
    </ul>
@endsection