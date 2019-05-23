@extends('template')
@extends('navbar')
@section('title', 'Likeユーザ画面')
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

    <!-- ユーザ一覧表示 -->
    @foreach ($like_users as $user)
        <?php $path = 'https://avatars.githubusercontent.com/' . $user->github_id ?>
        <img src="{{ asset($path) }}" width=30>
        <a href="{{ action('ProfileController@index', $user->id) }}">
            {{ $user->github_id }}
        </a>
    @endforeach
@endsection