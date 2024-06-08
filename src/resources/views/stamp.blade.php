@extends('layouts.layouts')

@section('css')
<link rel="stylesheet" href="{{ asset('css/stamp.css') }}">
@endsection

@section('content')
<body>
    <div class="user">
        <input type="text" class="user-name" name="name" value="{{ auth()->user()->name }}さんお疲れ様です!" readonly/>
        {{ session('message') }}
    </div>
    <div class="form-action">
        <form action="/work_start" method="POST">
        @csrf
            <div class="work__button">
                
                <button class="form-button-top" name="work_start" value="{{ Auth::user()->id }}">勤務開始</button>
            </div>
        </form>
        <form action="/work_end" method="POST">
        @csrf
            <div class="work__button">
                
                <button class="form-button-top" name="work_end" value="{{ Auth::user()->id }}">勤務終了</button></br>
            </div>
        </form>
    </div>
    <div class="rest">
        <form action="/rest_start" method="POST">
        @csrf
            <div class="rest__button">
                
                <button class="form-button-bottom" name="rest_start" value="{{ Auth::user()->id }}">休憩開始</button>
            </div>
        </form>
        <form action="/rest_end" method="POST">
        @csrf
            <div class="rest__button">
                
                <button class="form-button-bottom" name="rest_end" value="{{ Auth::user()->id }}">休憩終了</button>
            </div>
        </form>
    </div>
</body>
@endsection