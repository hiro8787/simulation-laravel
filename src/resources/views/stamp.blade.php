@extends('layouts.layouts')

@section('css')
<link rel="stylesheet" href="{{ asset('css/stamp.css') }}">
@endsection

@section('content')
<body>
    <div class="user">
        <input type="text" class="user-name" name="name" value="{{ auth()->user()->name }}さんお疲れ様です!" />
    </div>
    <div class="form-action">
        <form action="/stamp" method="POST">
        @csrf
            <input type="hidden" name="work_start" class="form-button-top" value="{{ 'work_start' }}">
            <input type="submit" class="form-button-top" value="業務開始" />
            <input type="submit" name="submit" class="form-button-top" value="業務終了" /></br>
            <input type="submit" name="submit" class="form-button-bottom" value="休憩開始" />
            <input type="submit" name="submit" class="form-button-bottom" value="休憩終了" />
        </form>
    </div>
</body>

@endsection