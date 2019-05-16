@extends('template')
@extends('parentheader1')
@section('title', 'ログイン画面')
@section('head')
    @section('header1')
        @parent
    @show
@endsection
@section('content')
    <!-- Githubログインボタン -->
    <input type="button" onclick="location.href='github'" value="githubでログイン">
@endsection