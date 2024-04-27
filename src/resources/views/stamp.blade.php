@extends('layouts.layouts')

@section('css')
<link rel="stylesheet" href="{{ asset('css/stamp.css') }}">
@endsection

@section('content')
<body>


    <h1>{{-- {{ $users['name'] }} --}}さんお疲れ様です！</h1>

    <div class="form-action">
    <form class="form" name="stamp" method="POST" action="/works">
    @csrf
        <input type="submit" name="submit" class="form-button" value="業務開始" />
        <input type="submit" name="submit" class="form-button" value="業務終了" /></br>
        <input type="submit" name="submit" class="form-button" value="休憩開始" />
        <input type="submit" name="submit" class="form-button" value="休憩終了" />
    </form>
</div>
</body>

@endsection