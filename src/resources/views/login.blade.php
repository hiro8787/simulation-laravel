@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<main>
    <div class="main">
        <div class="main-item">ログイン
            <form class="form" name="login" method="GET" action="/stamp">
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
        </div>
    </div>
</main>
@endsection