@extends('layouts.layouts')

@section('css')
<link rel="stylesheet" href="{{ asset('css/date.css') }}">
@endsection

@section('content')
<a>{{$today->isoFormat('YYYY-MM-DD')}}</a>
<table>
    <tr class="table-title">
        <td>名前</td>
        <td>勤務開始</td>
        <td>勤務終了</td>
        <td>休憩時間</td>
        <td>勤務時間</td>
    </tr>
    @foreach ($authors as $author)
    
    <tr class="table-title">
        <td>{{ $author->name }}</td>
        <td>{{ $author->work_start }}</td>
        <td>{{ $author->work_end }}</td>
        <td>{{ $author->rest_time }}</td>
        <td>{{ $author->work_time }}</td>
    </tr>
    
    @endforeach
</table>
<footer>
{{ $users->links('vendor.pagination.custom') }}
</footer>
@endsection
