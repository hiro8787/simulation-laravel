<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    @yield('css')
</head>

<body>
    <header>
        <div class="header">
            <div class="header-logo">Atte</div>
            <nav class="header-nav">
                @if (Auth::check())
                <div class="header-nav-list">
                    <form action="/stamp" method="GET">
                        @csrf
                        <input class="header-nav-item" type="submit" value="ホーム">
                    </form>
                    <form action="/date" method="GET">
                        @csrf
                        <input class="header-nav-item" type="submit" value="日付一覧">
                    </form>
                    <form action="/logout" method="POST">
                        @csrf
                        <input class="header-nav-item" type="submit" value="ログアウト">
                    </form>
                    @endif
                </div>
            </nav>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <div class="footer-logo">Atte,inc.</div>
    </footer>
</body>

</html>