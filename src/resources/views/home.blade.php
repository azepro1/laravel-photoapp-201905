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

    <!-- 画像一覧表示 -->
    @foreach ($posts as $post)
        <?php echo $post->nickname ?>
        <?php $path = 'storage/' . $post->path; ?>
        <img src = <?php echo $path ?> >
        <!-- ToDo {{}}の書き方に直す -->
        <?php echo $post->caption ?>
    @endforeach
@endsection