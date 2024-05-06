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

    public function store(Request $request)
    {
        $users = User::find('users_id');
        return view('stamp', ['users' => $users]);
    }

    public function date()
    {
        //$contact = $request->only('id,user_id');//
        $users = user::with('works')->Paginate(5);
        $works = work::all();
        return view('date', compact('users', 'works'));
        //return view('date', ['users' => $users]);
    }

}
