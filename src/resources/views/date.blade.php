@extends('layouts.layouts')

@section('css')
<link rel="stylesheet" href="{{ asset('css/date.css') }}">
@endsection

@section('content')
<a>{{$now->isoFormat('YYYY-MM-DD')}}</a>
<table>
    <tr class="table-title">
        <td>名前</td>
        <td>勤務開始</td>
        <td>勤務終了</td>
        <td>休憩時間</td>
        <td>勤務時間</td>
    </tr>
    @foreach ($authors as $author)
    @foreach ($users as $user)
    <tr class="table-title">
        <td>{{ $author->user->name}}</td>
        <td>{{ $author->work_start }}</td>
        <td>{{ $author->work_end }}</td>
        <td>{{ $author->rest_start }}</td>
        <td>勤務時間</td>
    </tr>
    @endforeach
    @endforeach
</table>
<footer>
{{ $users->links('vendor.pagination.custom') }}
</footer>
@endsection
