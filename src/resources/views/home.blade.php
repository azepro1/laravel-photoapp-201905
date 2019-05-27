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

  <!-- ログインしてる？ -->
  @if(Session::get('user_id'))
      <div class="float-right">
          {{ 'logged_in:' }}
          <a href="{{ action('ProfileController@index', $login_user->id) }}">
              {{ $login_user->social_id }}
              <img src="{{ asset($login_user->image_path) }}" width="35">
          </a>
      </div>
      <br>
  @else
    <div class="float-right text-danger">
      {{ 'You\'re not logged in' }}
    </div>
    <br>
  @endif
  <hr>

  <!-- 投稿部分 -->
  <div class="card-columns">
  @foreach ($posts as $post)
    <div class="card">
      <div class="image-delete">

        <!-- 画像の表示 -->
        <a href="{{ asset($post->path) }}" data-lity=”data-lity”>
          <img id="post_photo" class= "card-img-top img-fluid rounded" src="{{ asset($post->path) }}">
        </a>

        <!-- 投稿ユーザとログインユーザが同じ場合に削除ボタンを表示 -->
        @if($post->user_id === Session::get('user_id'))
        <form action="{{ action('PostController@destroy', $post->id) }}" id="form_{{ $post->id }}" method="post">
            {{ csrf_field() }}
            {{ method_field('delete') }}
            <button type="submit">
                <i class="far fa-trash-alt image-delete"></i>
            </button>
        </form>
        @else
        @endif
      </div>
      <div class="card-body">
        <!-- キャプションの表示 -->
        {{ $post->caption }}
        <!-- 投稿者の表示 -->
        <a> / posted by:</a>
        <a href="{{ action('ProfileController@index', $post->user_id) }}">{{ $post->nickname }}</a>
        <hr>
        <!-- いいねボタンの表示 -->
        <!-- if:ログイン済みの場合 -->
        @if(Session::get('user_id'))
            <!-- if:Like済みの場合 -->
            @if($post->liked)
                <form action="{{ action('LikeController@destroy', $post->id) }}" method="post" style="display:inline;" class="ml-4">
                    {{ csrf_field() }}
                    <?php $request->session()->put('user_id', Session::get('user_id')); ?>
                    <input type="submit" value="&#xf004; Liked" class="fas">
                </form>
            <!-- if:Likeしてない場合 -->
            @else
                <form action="{{ action('LikeController@store', $post->id) }}" method="post" style="display:inline;" class="ml-4">
                    {{ csrf_field() }}
                    <?php $request->session()->put('user_id', Session::get('user_id')); ?>
                    <input type="submit" value="&#xf004; Like!" class="fas like-color">
                </form>
            @endif
        <!-- else:ログインしてない場合：ボタン非アクティブ -->
        @else
            <input type="button" value="&#xf004; Like" class="fas like-color ml-4">
        @endif
        <!-- いいねしたユーザ一覧への遷移 -->
        <a href="{{ action('LikeUserController@index', $post->id) }}" class="ml-5">{{ $post->like_count }} Users Liked</a>
      </div>
    </div>
  @endforeach
  </div>

  <!--フッタ-->
  <ul class="pagination justify-content-center" style="margin:20px 0">
      {{ $posts->links() }}
  </ul>
@endsection