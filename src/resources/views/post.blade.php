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

    <!-- フォーム -->
    <form action="{{ url('upload') }}" method="POST" enctype="multipart/form-data">
        <label for="photo">画像ファイル:</label>
        <input type="file" class="form-control" name="file">
        <br>
        <label for="caption">キャプション:</label>
        <input type="text" class="form-control" name="caption" size="50">
        <br>
        <hr>
        {{ csrf_field() }}
        <button class="btn btn-success"> Upload </button>
    </form>
@endsection