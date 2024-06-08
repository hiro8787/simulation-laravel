@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<main>
    <div class="main">
        @if (count($errors) > 0)
        <p class="error-title">入力に問題があります</p>
        @endif
        <div class="main-item">会員登録
            <form class="form" method="POST" action="/register">
                @csrf
                <div class="form-item">
                    <div class="form-item-text">
                        <input type="name" name="name" class="form-item-input" placeholder="名前" value="{{ old('name') }}"/>
                    </div>
                    <div class="error">
                    @error('name')
                    {{$errors->first('name')}}
                    @enderror
                    </div>
                    <div class="form-item-text">
                        <input type="email" name="email" class="form-item-input" placeholder="メールアドレス" value="{{ old('email') }}"/>
                    </div>
                    @error('email')
                    {{$errors->first('email')}}
                    @enderror
                    </div>
                    <div class="form-item-text">
                        <input type="password" name="password" class="form-item-input" placeholder="パスワード" value="{{ old('password') }}"/>
                    </div>
                    <div class="error">
                    @error('password')
                    {{$errors->first('password')}}
                    @enderror
                    </div>
                    <div class="form-item-text">
                        <input type="password" name="password_confirmation" class="form-item-input" placeholder="確認用パスワード" value="{{ old('password') }}"/>
                    </div>
                    <div class="error">
                    @error('password_confirmation')
                    {{$errors->first('password_confirmation')}}
                    @enderror
                    </div>
                    <div class="form-item-category">
                        <button type="submit" class="form-item-btn">会員登録</button>
                    </div>
                </div>
            </form>
            <div class="form-guidance">アカウントをお持ちの方はこちらから</div>
            <a class="entry-item" href="/login">ログイン</a>
        </div>
    </div>
</main>
@endsection