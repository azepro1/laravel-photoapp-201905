@extends('template')
@extends('navbar')
@section('title', 'プロフィール画面')
@section('head')
    @section('navbar')
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

    <!--ToDo: CSSの読み込みがうまくいかない -->
    <div class="media mt-5 mb-3">
        <!-- アイコンの表示 -->
        <?php $path = 'https://avatars.githubusercontent.com/' . $nickname ?>
            <img class="align-self-center mr-3" src="{{ asset($path) }}" width=50>
            <div class="media-body">
                <!-- ニックネームの表示 -->
                <h5>{{ $nickname }}</h5>
                <!-- Like数の表示 -->
                <p>もらったLikeの数：　{{ $likes_count }}</p>
        </div>
    </div>

    <!-- 画像一覧表示 -->
    <div class="row">
        @foreach ($posts as $post)
            <div class="col-md-3 m-0 p-0">
                <!-- 画像の表示 -->
                <?php $path = 'storage/' . $post->path; ?>
                <img class="img-fluid" src="{{ asset($path) }}">
            </div>
        @endforeach
    </div>
@endsection