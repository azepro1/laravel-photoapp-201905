@extends('template')
@extends('navbar')
@section('title', 'ログイン画面')
@section('head')
    @section('navbar')
        @parent
    @show
@endsection
@section('content')
    <br>
    <br>
    <br>
    <!-- Githubログインボタン -->
    <a href="auth/login/github" class="btn btn-primary btn-block mt-11">GitHubでログイン</a>
    <!-- Facebookログインボタン -->
    <a href="auth/login/facebook" class="btn btn-primary btn-block mt-11">Facebookでログイン</a>
@endsection