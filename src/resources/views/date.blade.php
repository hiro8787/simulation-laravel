@extends('layouts.layouts')

@section('css')
<link rel="stylesheet" href="{{ asset('css/date.css') }}">
@endsection

@section('content')

<table>
    <tr class="table-title">
        <td>名前</td>
        <td>勤務開始</td>
        <td>勤務終了</td>
        <td>休憩時間</td>
        <td>勤務時間</td>
    </tr>
    @foreach ($users as $user)
    <tr class="table-title">
        <td>{{ $user->getDetail()['name'] }}</td>
        <td>{{ $user->getDetail()['work_start'] }}</td>
        <td>勤務終了</td>
        <td>休憩時間</td>
        <td>勤務時間</td>
    </tr>
    @endforeach

    
</table>
<footer>
{{ $users->links('vendor.pagination.custom') }}
</footer>
@endsection