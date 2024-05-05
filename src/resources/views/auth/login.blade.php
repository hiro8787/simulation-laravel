@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<main>
    <div class="main">
        <div class="main-item">ログイン
            <form class="form" method="POST" action="/login">
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
                
                
            </form>
            <div class="form-guidance">アカウントをお持ちでない方はこちらから</div>
                <a class="entry-item" href="/register">会員登録</a>
        </div>
    </div>
</main>
@endsection