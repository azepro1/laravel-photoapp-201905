@extends('template')
@extends('navbar')
@section('title', 'ホーム画面')
@section('head')
    @section('navbar')
        @parent
    @show
@endsection
@section('content')
    <!-- 画像投稿時のエラーメッセージ。 -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif

    <!-- フォーム -->
    <form action="/upload" method="POST" enctype="multipart/form-data">
        <label for="photo">画像ファイル:</label>
        <input type="file" class="form-control" name="photo">
        <br>
        <label for="caption">キャプション:</label>
        <input type="text" class="form-control" name="caption" size="50">
        <br>
        <hr>
        {{ csrf_field() }}
        <button class="btn btn-primary"> 投稿 </button>
    </form>
@endsection