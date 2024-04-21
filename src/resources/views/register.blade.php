@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<main>
    <div class="main">
        <div class="main-item">会員登録
            <form class="form" name="login" method="GET" action="/stamp">
                @csrf
                <div class="form-item">
                    <div class="form-item-text">
                        <input type="name" name="name" class="form-item-input" placeholder="名前" value="{{ old('name') }}"/>
                    </div>
                    <div class="form-item-text">
                        <input type="email" name="email" class="form-item-input" placeholder="メールアドレス" value="{{ old('email') }}"/>
                    </div>
                    <div class="form-item-text">
                        <input type="password" name="password" class="form-item-input" placeholder="パスワード" value="{{ old('password') }}"/>
                    </div>
                    <div class="form-item-text">
                        <input type="password" name="password" class="form-item-input" placeholder="確認用パスワード" value="{{ old('password') }}"/>
                    </div>
                    <div class="form-item-category">
                        <button type="submit" class="form-item-btn">会員登録</button>
                    </div>
                </div>
                <div class="form-guidance">アカウントをお持ちの方はこちらから</div>
                <a href="http://localhost/stamp/" class="entry-item">ログイン</a>
            </form>
        </div>
    </div>
</main>
@endsection