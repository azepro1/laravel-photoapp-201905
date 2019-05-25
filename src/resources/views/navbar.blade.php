@section('navbar')
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <a class="navbar-brand ml-5" href="/">Instaもどき</a>
        <ul class="navbar-nav">
            @if (Session::get('user_id'))
                <li class="nav-item">
                    <a class="nav-link" href="/">ホーム</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">ログアウト</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/post">投稿</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="/">ホーム</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/login">ログイン</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/login">投稿</a>
                </li>
            @endif
        </ul>
    </nav>
@show