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
        <img src="{{ asset($user->image_path) }}" width=30>
        <a href="{{ action('ProfileController@index', $user->id) }}">
            {{ $user->social_id }}
        </a>
        <hr>
    @endforeach
@endsection