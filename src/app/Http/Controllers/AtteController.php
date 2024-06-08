<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Work;
use App\Models\Rest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AtteController extends Controller
{
    public function index()
    {
        $users = User::with('works')->get();
        return view('auth.login', compact('users'));
    }

    public function store()
    {
        $user = Auth::user();
        return view('stamp', compact('user'));
    }

    public function work_start()
    {
        $user = Auth::user();
        $oldTimeIn = Work::where('user_id', $user->id)->latest()->first();
        $oldDay = '';
        if($oldTimeIn){
            $oldTimeWorkStart = new Carbon($oldTimeIn->work_start);
            $oldDay = $oldTimeWorkStart->startOfDay();
        }
        $today = Carbon::today();
        if($oldTimeIn && $oldDay == $today){
            return redirect()->back()->with('message', '本日は既に勤務開始しています。');
        }
        Work::create([
            'user_id' => $user->id,
            'work_start' => Carbon::now()
        ]);
        return redirect()->back();//->with('disabled', $disabled);
    }

    public function work_end()
    {
        $user = Auth::user();
        $workEnd = Work::leftJoin('rests', 'rests.work_id', '=', 'works.id')
            ->where('works.user_id', $user->id)
            ->orderBy('works.created_at', 'desc')
            ->select('works.*', 'rests.rest_start', 'rests.rest_end')
            ->first();
        if($workEnd){
            if(empty($workEnd->work_end)){
                if($workEnd->rest_start && !$workEnd->rest_end){
                    return redirect()->back()->with('message', '休憩終了前です');
                }else{
                    $now = Carbon::now();
                    $workStart = new Carbon($workEnd->work_start);
                    $restTime = Rest::where('work_id', $workEnd->id)
                        ->whereNotNull('rest_end')
                        ->get()
                        ->sum(function ($rest){
                            return Carbon::parse($rest->rest_start)->diffInMinutes(Carbon::parse($rest->rest_end));
                        });
                    $workTime = $workStart->diffInMinutes($now) - $restTime;
                    $workEnd->update([
                        'work_end' => $now,
                        'work_date' => $workTime
                    ]);
                    return redirect()->back()->with('message', 'お疲れ様でした');
                }
            }else{
                return redirect()->back()->with('message', '退勤済みです');
            }
        }else{
            return redirect()->back()->with('message', '出勤打刻がされてません');
        }
    }

    public function rest_start()
    {
        $user = Auth::user();
        $work = Work::where('user_id', $user->id)
            ->whereNull('work_end')
            ->first();
        if(!$work){
        return redirect()->back()->with('message', '勤務開始後でないと休憩開始はできません。');
        }
        Rest::create([
        'work_id' => $work->id,
        'rest_start' => Carbon::now()
        ]);
        return redirect()->back()->with('message', '休憩開始しました。')->with('disabledRestEnd', false);
    }

    public function rest_end()
    {
        $user = Auth::user();
        $userWithWork = Rest::join('works', 'works.id', '=', 'rests.work_id')
            ->where('works.user_id', $user->id)
            ->whereNull('rests.rest_end')
            ->orderBy('rests.created_at', 'desc')
            ->select('rests.*')
            ->first();
        if($userWithWork) {
            $restStart = Carbon::parse($userWithWork->rest_start);
            $restEnd = Carbon::now();
            $restTime = $restStart->diffInMinutes($restEnd);
            $userWithWork->update([
                'rest_end' => $restEnd,
                'rest_time' => $restTime
            ]);
            return redirect()->back()->with('message', '休憩終了しました。')->with('disabledRestEnd', true);
        }else{
            return redirect()->back()->with('message', '休憩開始をしていません。')->with('disabledRestEnd', false);
        }
    }

    public function date(Request $request)
    {
        $date = $request->input('date', Carbon::today()->toDateString());
        $currentDate = Carbon::parse($date);
        $yesterday = $currentDate->copy()->subDay();
        $tomorrow = $currentDate->copy()->addDay();
        $authors = User::join('works', 'works.user_id', 'users.id')
            ->leftJoin('rests', 'rests.work_id', 'works.id')
            ->whereDate('works.created_at', $currentDate)
            ->whereNotNull('works.work_end')
            ->select('users.*', 'works.work_start', 'works.work_end', 'works.work_date', 'rests.rest_start', 'rests.rest_end', 'rests.rest_time')
            ->paginate(5);
        foreach ($authors as $author) {
            $author->work_date = gmdate('H:i:s', $author->work_date * 60);
            $author->rest_time = gmdate('H:i:s', $author->rest_time * 60);
        }
        $user = User::with('works')->paginate(5);
        return view('date', compact('user', 'currentDate', 'authors', 'yesterday', 'tomorrow'));
    }
}
