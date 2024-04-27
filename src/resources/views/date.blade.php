@extends('layouts.layouts')

@section('css')
<link rel="stylesheet" href="{{ asset('css/date.css') }}">
@endsection

@section('content')
<p>a</p>
<table>
    <tr class="table-title">
        <td>名前</td>
        <td>勤務開始</td>
        <td>勤務終了</td>
        <td>休憩時間</td>
        <td>勤務時間</td>
    </tr>
    <tr class="table-title">
        <td>テスト太郎</td>
        <td>勤務開始</td>
        <td>勤務終了</td>
        <td>休憩時間</td>
        <td>勤務時間</td>
    </tr>
    <tr class="table-title">
        <td>テスト次郎</td>
        <td>勤務開始</td>
        <td>勤務終了</td>
        <td>休憩時間</td>
        <td>勤務時間</td>
    </tr>
    <tr class="table-title">
        <td>テスト三郎</td>
        <td>勤務開始</td>
        <td>勤務終了</td>
        <td>休憩時間</td>
        <td>勤務時間</td>
    </tr>
    <tr class="table-title">
        <td>テスト四郎</td>
        <td>勤務開始</td>
        <td>勤務終了</td>
        <td>休憩時間</td>
        <td>勤務時間</td>
    </tr>
    <tr class="table-title">
        <td>テスト五郎</td>
        <td>勤務開始</td>
        <td>勤務終了</td>
        <td>休憩時間</td>
        <td>勤務時間</td>
    </tr>
    @foreach ($users as $user)
    <tr>
        <td>
            {{ $user->getDetail() }}
        </td>
    </tr>
    @endforeach
</table>
{{ $users->links() }}
@endsection