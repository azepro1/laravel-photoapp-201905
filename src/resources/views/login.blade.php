@extends('template')
@extends('navbar')
@section('title', 'ログイン画面')
@section('head')
    @section('navbar')
        @parent
    @show
@endsection
@section('content')
    <!-- Githubログインボタン -->
    <a href="/auth/login/github" class="btn btn-primary btn-block">GitHubでログイン</a>
    <!-- Facebookログインボタン -->
    <a href="/auth/login/facebook" class="btn btn-primary btn-block">Facebookでログイン</a>
@endsection