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

    <!-- ユーザ一覧表示 -->
    @foreach ($like_users as $user)
        <?php $path = 'https://avatars.githubusercontent.com/' . $user->github_id ?>
        <img src="{{ asset($path) }}" width=30>
        {{ $user->github_id }}
        <hr>
    @endforeach
@endsection