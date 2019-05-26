@section('navbar')
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <a class="navbar-brand ml-5 title-font" href="/">Insta-like</a>
        <ul class="navbar-nav">
            @if (Session::get('user_id'))
                <li class="nav-item">
                    <a class="nav-link" href="/post">Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Logout</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="/login">Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/login">Login</a>
                </li>
            @endif
        </ul>
    </nav>
@show