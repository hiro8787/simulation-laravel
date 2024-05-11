<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\User;
use App\Models\Work;
use App\Models\Rest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AtteController extends Controller
{

    public function index()
    {
        $users = User::with('works')->get();
        //dd($users);
        return view('auth.login', compact('users'));
    }

    public function store(Request $request)
{
    //dd($request);
    //$work_start = $request->input('work_start');
    // 保存処理
    $items = Work::all();
    return view('stamp', ['items'=>$items]);
    //$post = new Work;
        //投稿する際に、ログインしている人のIDが保存されるようにします。
        //$post->user_id = Work::id();
        //$post->work_start = $request->work_start;
        
        //$post->save();
        //return redirect(stamp)->route('post.create');
    }

    public function date(Request $request)
    {
        $users = Work::all();
        
        $now = Carbon::now();
        //$contact = $request->only('id,user_id');//
        //$users = $request->all();
        //$works = Work::find($request->work_id);
        $users = User::with('works')->Paginate(5);
        $work_start = request('work_start');
        //dd($request);
        $work_start = date('H:i:s');


        return view('date', compact('users', 'work_start','now'));
        //return view('date', ['users' => $users]);
        
    }

    //public function add(){
        //$items = Work::all();
        //return view('date', ['items' => $items]);
    //}

    public function create(Request $request){
        $this->validate($request, Work::$rules);
        $form = $request->all();
        Work::create($form);
        return redirect('/work');
    }

}
