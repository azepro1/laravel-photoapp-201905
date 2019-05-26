@extends('template')
@extends('navbar')
@section('title', 'ログイン画面')
@section('head')
    @section('navbar')
        @parent
    @show
@endsection
@section('content')
    <!-- ログアウト時のメッセージ。 -->
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <br>
    <br>
    <!-- Githubログインボタン -->
    <a href="/auth/login/github" class="btn btn-primary btn-block">Login with GitHub</a>
    <br>
    <!-- Facebookログインボタン -->
    <a href="/auth/login/facebook" class="btn btn-primary btn-block">Login with Facebook</a>
@endsection