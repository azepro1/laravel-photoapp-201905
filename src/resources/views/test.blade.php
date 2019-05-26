@extends('template')
@extends('navbar')
@section('title', 'テスト用画面')
@section('head')
    @section('navbar')
        @parent
    @show
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/test.js"></script>
@endsection
@section('content')
  <h2>Hello World!!</h2>
  <p>皆さん、こんにちは</p>
<hr />
<div id="outarea_aa">outarea_aa</div>
<div id="outarea_bb">outarea_bb</div>
<div id="outarea_cc">outarea_cc</div>
<div id="outarea_dd">outarea_dd</div>
<div id="outarea_ee">outarea_ee</div>
<div id="outarea_ff">outarea_ff</div>
<div id="outarea_gg">outarea_gg</div>
<div id="outarea_hh">outarea_hh</div>
<hr />
Jun/20/2018<p />
@endsection
