@extends('template')
@extends('parentheader2')
@section('title', 'ホーム画面')
@section('head')
    @section('header2')
        @parent
    @show
@endsection
@section('content')
    <!-- エラーメッセージ。なければ表示しない -->
    @if ($errors->any())
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <!-- temp. ログインしてる？ -->
    @if(Session::get('user_id'))
        {{ 'ログインしてる :' }} {{ Session::get('user_id') }}
    @else
        {{ 'ログインしてない' }}
    @endif
    <hr>

    <!-- 画像一覧表示 -->
    @foreach ($posts as $post)
        <!-- ニックネームの表示 -->
        ユーザ名
        <a href="{{ action('ProfileController@index', $post->user_id) }}">{{ $post->nickname }}</a>
        <!-- 投稿ユーザとログインユーザが同じ場合に削除ボタンを表示 -->
        @if($post->user_id === Session::get('user_id'))
            <form action="{{ action('PostController@destroy', $post->id) }}" id="form_{{ $post->id }}" method="post">
                {{ csrf_field() }}
                {{ method_field('delete') }}
                <button class="btn"> 削除 </button>
            </form>
        @else
        @endif
        <br>
        <!-- 画像の表示 -->
        <?php $path = 'storage/' . $post->path; ?>
        <img src="{{ asset($path) }}">

        <br>
        <!-- キャプションの表示 -->
        {{ $post->caption }}
        <br>
        <!-- いいねボタンの表示 -->
        <!-- if:ログイン済みの場合 -->
        @if(Session::get('user_id'))
            <!-- if:Like済みの場合 -->
            @if($post->liked)
                <form action="{{ action('LikeController@destroy', $post->id) }}" method="post">
                    {{ csrf_field() }}
                    <input type="image" src="images/favorited_button.jpeg" width="30"> {{ 'Likeしました' }}
                    <?php $request->session()->put('user_id', Session::get('user_id')); ?>
                </form>
            <!-- if:Likeしてない場合 -->
            @else
                <form action="{{ action('LikeController@store', $post->id) }}" method="post">
                    {{ csrf_field() }}
                    <input type="image" src="images/favorite_button.jpeg" width="30"> {{ 'Likeする' }}
                    <?php $request->session()->put('user_id', Session::get('user_id')); ?>
                </form>
            @endif
        <!-- else:ログインしてない場合：ボタン非アクティブ -->
        @else
            <input type="image" src="images/favorited_button.jpeg" width="30">
        @endif

        <!-- いいねしたユーザ一覧への遷移 -->
        <form action="{{ action('LikeUserController@index', $post->id) }}" method="get">
            <button class="btn"> Likeしたユーザ </button>
        </form>

        <hr>
    @endforeach
    {{ $posts->links() }}
@endsection