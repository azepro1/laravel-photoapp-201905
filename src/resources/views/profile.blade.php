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

    <!-- アイコンの表示 -->
    <?php $path = 'https://avatars.githubusercontent.com/' . $nickname ?>
    <img src="{{ asset($path) }}" width=30>
    <!-- ニックネームの表示 -->
    {{ $nickname }}
    <!-- Like数の表示 -->
    もらったLike　{{ $likes_count }}
    <hr>

    <!-- 画像一覧表示 -->
    @foreach ($posts as $post)
        <!-- 画像の表示 -->
        <?php $path = 'storage/' . $post->path; ?>
        <img src="{{ asset($path) }}">
        <br>
    @endforeach
@endsection