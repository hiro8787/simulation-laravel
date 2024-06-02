<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
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
            return redirect()->back()->with('message', '本日は既に退勤しています。');
        }
        if(($oldDay == $today) && (empty($oldTimeIn->work_end))){
            $disabled = true;
        }else{
            $disabled = false;
        }
        if($disabled){
            return redirect()->back()->with('message', '既に勤務開始しています。');
        }

        Work::create([
            'user_id' => $user->id,
            'work_start' => Carbon::now(),
        ]);

        return redirect()->back()->with('disabled', $disabled);
    }

    public function work_end()
    {
        $user = Auth::user();
        $workEnd = Work::where('user_id', $user->id)->latest()->first();
        $now = new Carbon();
        $workStart = new Carbon($workEnd->work_start);
        $restStart = new Carbon($workEnd->rest_start);
        $restEnd = new Carbon($workEnd->rest_end);
        $stayTime = $workStart->diffInMinutes($now);
        $restTime = $restStart->diffInMinutes($restEnd);
        $workTime = $stayTime-$restTime;

        if($workEnd){
            //退勤処理をしていない場合
            if(empty($workEnd->work_end)){
                if($workEnd->rest_start && !$workEnd->rest_end){
                    return redirect()->back()->with('message','休憩終了前です');
                }
                else {
                    $workEnd->update([
                        'work_end'=> Carbon::now(),
                        'work_data' => $workTime
                    ]);
                    return redirect()->back()->with('message','お疲れ様でした');
                }
            }
            else{
                $today = new Carbon();
                $day = $today->day;
                $oldWorkEnd = new Carbon();
                $oldWorkEndDay = $oldWorkEnd->day;
                if($day == $oldWorkEndDay){
                    return redirect()->back()->with('message','退勤済みです');
                }
                else{
                    return redirect()->back()->with('message','出勤打刻をしてください');
                }
            }
        }
        else {
            return redirect()->back()->with('message','出勤打刻がされてません');
        }
    }
/*
    public function rest_start()
    {
        $user = Auth::user();

        $userWithWork = Rest::join('works', 'works.id', '=', 'rests.work_id')
            ->where('works.user_id', $user->id)
            ->orderBy('works.created_at', 'desc')
            ->select('rests.*')
            ->first();
        //dd($userWithWork);
        $disabledRest = false;

        if($userWithWork) {
            if($userWithWork->rest_start && !$userWithWork->rest_end){
                $disabledRest = true;
                return redirect()->back()->with('message', '既に休憩開始しています。')->with('disabledRest', $disabledRest);
            }

            $userWithWork->update(['rest_start' => Carbon::now()]);
        }else{
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
    }

    return redirect()->back()->with('disabledRest', $disabledRest);
}
*/

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

        $disabledRestEnd = false;

        if($userWithWork)
        {
            $userWithWork->update([
                'rest_end' => Carbon::now()
            ]);
            $disabledRestEnd = true;
            return redirect()->back()->with('message', '休憩終了しました。')->with('disabledRestEnd', $disabledRestEnd);
        }

        return redirect()->back()->with('message', '休憩開始をしていません。')->with('disabledRestEnd', $disabledRestEnd);
    }

/*
    public function rest_end()
{
    $user = Auth::user();

    // worksテーブルのuser_idとrestsテーブルのwork_idをjoinし、ログインユーザーのidと一致させる
    $userWithWork = Rest::join('works', 'works.id', '=', 'rests.work_id')
        ->where('works.user_id', $user->id)
        ->whereNull('rests.rest_end') // 休憩終了がまだのレコードを取得
        ->orderBy('rests.created_at', 'desc')
        ->select('rests.*') // restsテーブルのカラムを選択
        ->first();

    $disabledRestEnd = false;

    if ($userWithWork) {
        if (!empty($userWithWork->rest_start)) {
            $userWithWork->update([
                'rest_end' => Carbon::now()
            ]);
            $disabledRestEnd = true;
            return redirect()->back()->with('message', '休憩終了しました。')->with('disabledRestEnd', $disabledRestEnd);
        }
    }

    return redirect()->back()->with('message', '休憩開始をしていません。')->with('disabledRestEnd', $disabledRestEnd);
}
*/

    public function date()
    {
        //このページは本日の日付の処理が表示される画面

        $authors = Work::paginate(5);
        $this->date['authors']=$authors;
        //dd($authors);
        $user = Auth::user();
        $userData = User::join('works','works.user_id','users.id')
        ->join('rests','rests.id','works.user_id');
        $now = Carbon::now();
        $users = User::with('works')->Paginate(5);
        //dd($authors);
        //$work_start = Carbon::now();
        //$work_start = date('H:i:s');
        
        //dd($times);
        
        return view('date', compact('user','users', 'now', 'authors'));
    }

    //public function add(){
        //$items = Work::all();
        //return view('date', ['items' => $items]);
    //}

    public function create(Request $request){
        $this->validate($request, Work::$rules);
        $form = $request->all();
        Work::create($form);
        return redirect('date');
    }

}
