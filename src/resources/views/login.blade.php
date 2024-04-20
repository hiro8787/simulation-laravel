<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Atte</title>
</head>

<body>
    <header>
        <div class="header">
            <div class="header-logo">Atte</div>
        </div>
    </header>
    <main>
        <div class="main">
            <div class="main-item">ログイン
            <form class="form" name="login" method="POST" action="/stamp">
                @csrf
                <div class="form-item">
                    <div class="form-item-text">
                        <input type="email" name="email" class="form-item-input" placeholder="メールアドレス" value="{{ old('email') }}"/>
                    </div>
                    <div class="form-item-text">
                        <input type="password" name="password" class="form-item-input" placeholder="パスワード" value="{{ old('password') }}"/>
                    </div>
                    <div class="form-item-category">
                        <button type="submit" class="form-item-btn">ログイン</button>
                    </div>
                    </div>
                    <div class="form-guidance">アカウントをお持ちでない方はこちらから</div>
                    <a href="http://localhost/register/" class="entry-item">会員登録</a>
                
            </form>
    </main>
    <footer>
        <div class="footer-logo">Atte,inc.</div>
    </footer>
</body>

</html>