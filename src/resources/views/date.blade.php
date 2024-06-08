@extends('layouts.layouts')

@section('css')
<link rel="stylesheet" href="{{ asset('css/date.css') }}">
@endsection

@section('content')
<div>
    <form class="day" action="{{ url('/date') }}">
        <button class="day-item" type="submit" name="date" value="{{ $yesterday->toDateString() }}"><</button>
        <span>{{ $currentDate->toDateString() }}</span>
        <button class="day-item" type="submit" name="date" value="{{ $tomorrow->toDateString() }}">></button>
    </form>
</div>
<table>
    <tr class="table-title">
        <td>名前</td>
        <td>勤務開始</td>
        <td>勤務終了</td>
        <td>休憩時間</td>
        <td>勤務時間</td>
    </tr>
    @foreach ($authors as $author)
    <tr class="table-title-date">
        <td>{{ $author->name }}</td>
        <td>{{ $author->work_start = \Carbon\Carbon::parse($author->work_start)->format('H:i:s') }}</td>
        <td>{{ $author->work_end = \Carbon\Carbon::parse($author->work_end)->format('H:i:s')}}</td>
        <td>{{ $author->rest_time }}</td>
        <td>{{ $author->work_date }}</td>
    </tr>
    @endforeach
</table>
<footer>
{{ $user->links('vendor.pagination.custom') }}
</footer>
@endsection