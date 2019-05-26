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

    <div class="media">
        <!-- アイコンの表示 -->
            <img class="align-self-center mr-3" src="{{ asset($image_path) }}" width=50>
            <div class="media-body">
                <!-- ニックネームの表示 -->
                <h5>{{ $nickname }}</h5>
                <!-- Like数の表示 -->
                <p>Received {{ $likes_count }} Likes</p>
        </div>
    </div>

    <!-- 画像一覧表示 -->
    <div class="row">
        @foreach ($posts as $post)
            <div class="col-md-3 m-0 p-0">
                <!-- 画像の表示 -->
                <img class="img-fluid" src="{{ asset($post->path) }}">
            </div>
        @endforeach
    </div>
@endsection