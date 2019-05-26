@extends('template')
@extends('navbar')
@section('title', 'ホーム画面')
@section('head')
    @section('navbar')
        @parent
    @show
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/post.js"></script>
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
        <label for="photo">Photo:</label>
        <input type="file" class="form-control" name="photo">
        <br>
        <label for="caption">Comment:</label>
        <input type="text" class="form-control" name="caption" size="50">
        <br>
        <div class="col text-center">
            <img id="post-img" class="mx-auto" style="display:none; width:200px;" />
        </div>
        <hr>
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block"> Post! </button>
    </form>
@endsection