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
        //勤務開始は１日１回（１回押すと非活性にする）
        $user = Auth::user();
        //WorkモデルのユーザーIDカラムがログインしているユーザーIDと同じ最新の最初のデータを取得し$oldTimeInに格納
        $oldTimeIn = Work::where('user_id', $user->id)->latest()->first();
        
        $oldDay = '';

        //ユーザーIDカラムがログインユーザーIDと同じなら
        if($oldTimeIn){
            //ログインユーザーの勤務開始日時の取得
            $oldTimeWorkStart = new Carbon($oldTimeIn->work_start);
            //勤務開始した日付を$oldDayに代入
            $oldDay = $oldTimeWorkStart->startOfDay();
        }
        $today = Carbon::today();
        //勤務開始日と今日の日付が等しく勤務終了をしていない場合メッセージを表示してリダイレクト
        if(($oldDay == $today) && (empty($oldTimeIn->work_end))){
            return redirect()->back()->with('message','出勤打刻済みです');
        }
        //ユーザーIDカラムがログインユーザーIDと同じなら
        if($oldTimeIn){
            //勤務終了日時を取得
            $oldTimeWorkEnd = new Carbon($oldTimeIn->work_end);
            //勤務終了した日付を$oldDayに代入
            $oldDay = $oldTimeWorkEnd->startOfDay();
        }
        //勤務開始と勤務終了の日付が今日と同じ日付で既に入っている場合メッセージを表示してリダイレクト
        if($oldDay == $today){
            return redirect()->back()->with('message','退勤打刻済みです');
        }

        $times = Work::create([
            'user_id' => $user->id,
            'work_start' => Carbon::now(),
        ]);
        return redirect()->back();
    }

    public function work_end(Request $request)
    {
        //勤務終了は勤務開始をしていないと押せない（勤務開始をしていない時は非活性にする）
        //勤務終了は１日１回
        $user = Auth::user();
        //dd($user);
        //WorkモデルのユーザーIDカラムがログインしているユーザーIDと同じ最新の最初のデータを取得し$workEndに格納
        $workEnd = Work::join('rests', 'rests.work_id', '=', 'works.user_id')
            ->where('works.user_id', $user->id)
            ->first();
        dd($workEnd);

        //現在日時を格納
        $now = new Carbon();
        //業務開始用の日時を格納
        $workStart = new Carbon($workEnd->work_start);
        //dd($workStart);
        //休憩開始用の日時を格納
        $restStart = new Carbon($workEnd->rest_start);
        //dd($restStart);
        //休憩終了の日時を格納
        $restEnd = new Carbon($workEnd->rest_end);
        //滞在時間を格納（後程休憩時間を差し引きする）
        $stayTime = $workStart->diffInMinutes($now);
        //休憩時間を格納
        $restTime = $restStart->diffInMinutes($restEnd);
        //勤務時間を格納
        $workTime = $stayTime-$restTime;

    //
        if($workEnd){
            //退勤処理をしていない場合
            if(empty($workEnd->work_end)){
                //退勤処理をしていない場合で出勤開始もしていない場合
                if($workEnd->workStart){
                    return redirect()->back->with('message','勤務開始前です');
                }
                //出勤済みで退勤処理がまだで休憩をしていない場合リダイレクトしてメッセージ表示
                if($workEnd->rest_start || $workEnd->rest_end){
                    return redirect()->back()->with('message','休憩がまだです');
                    }
                    //退勤処理が実行されれば退勤時間と勤務時間を代入する
                    else{
                    $workEnd->update([
                        'work_end' => Carbon::now(),
                        'work_data' => $workTime
                    ]);
                    return redirect()->back()->with('message','お疲れ様でした');
                }
            }
            //退勤済みの場合
            else{
                $today = new Carbon();
                $day = $today->day;
                $oldWorkEnd = new Carbon();
                $oldWorkEndDay = $oldWorkEnd->day;
                if($day == $oldWorkEndDay){
                return redirect()->back()->with('message','退勤済みです');
                }
            }
        }$times = Rest::create([
            'work_id' => $user->id,
            'rest_start' => Carbon::now(),
        ]);
    }

    public function rest_start()
    {
        
        //休憩開始は１度押すと休憩終了まで非活性にする
        //勤務開始後でないと休憩開始は押せない
        $user = Auth::user();
        
        $restStart = Work::where('user_id', $user->id)->latest()->first();

        $userWithWork = Work::join('rests', 'rests.work_id', '=', 'works.user_id')
        ->where('works.user_id', $user->id)
        ->first();
        //dd($userWithWork);
        //勤務開始をしていて勤務終了前の処理
        
        if($userWithWork->work_start && !$userWithWork->work_end && !$userWithWork->rest_start){
            $userWithWork->update([
            'rest_start'=> Carbon::now()
            ]);
        }
        else{
            return redirect()->back()->with('message','勤務時間外です');
        }
        
        //$restStart = new Carbon($restStart->rest_start);
        
        return redirect()->back();
    }

    public function rest_end()
    {
        //休憩終了は休憩開始をしていないと押せない
        $user = Auth::user();
        
        //$userWithWork = $user->join('rests', 'rests.work_id', '=', 'works.id');
        
        //dd($userWithWork);
        $restEnd = Rest::where('work_id',$user->id)->latest()->first();
        $userWithWork = Work::join('rests', 'rests.work_id', '=', 'works.user_id')
        ->where('works.user_id', $user->id)
        ->first();
        //dd($userWithWork);
        //勤務終了がまだで休憩開始処理をされてる時の処理
        if(!$restEnd->work_end && $restEnd->rest_start){
            $restEnd->update([
            'rest_end'=> Carbon::now()
            ]);
        }
        else{
            return redirect()->back()->with('message','勤務時間外もしくは休憩開始がされてません');
        }
        //$restEnd = new Carbon($restEnd->rest_end);
        return redirect()->back();
    }


    public function date()
    {
        //休憩テーブルとワークテーブルをジョインする
        //このページは本日の日付の処理が表示される画面

        $authors = Work::paginate(5);
        $this->date['authors']=$authors;
        //dd($authors);
        $user = Auth::user();
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
