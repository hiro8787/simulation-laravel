<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Work;
use App\Models\Rest;
use Illuminate\Http\Request;

class AtteController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('auth.login', compact('users'));
    }


    public function store()
    {
        $users = User::all();
        return view('stamp', ['users' => $users]);
    }
    
    public function date()
    {
        //$contact = $request->only('id,user_id');//
        $users = user::with('works')->Paginate(7);
        $works = work::all();
        return view('date', compact('users', 'works'));
        //return view('date', ['users' => $users]);
    }
    //public function aaa()
    //{
    //    $works = work::Paginate(4);
    //    return view('date', ['works' => $works]);
    //}
}
