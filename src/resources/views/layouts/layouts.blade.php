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
                <ul class="header-nav-list">
                    <li class="header-nav-item"><a href="../stamp">ホーム</a></li>
                    <li class="header-nav-item"><a href="../date">日付一覧</a></li>
                    <li class="header-nav-item"><a href="../">ログアウト</a></li>
                </ul>
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