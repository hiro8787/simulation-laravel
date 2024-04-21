<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    @yield('css')
</head>

<body>
    <header>
        <div class="header">
            <div class="header-logo">Atte</div>
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