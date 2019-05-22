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
    <input class="btn btn-primary btn-block mt-11" type="button" onclick="location.href='github'" value="githubでログイン">
@endsection