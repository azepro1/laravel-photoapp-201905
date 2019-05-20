@extends('template')
@extends('parentheader1')
@section('title', 'ログイン画面')
@section('head')
    @section('header1')
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