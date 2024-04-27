<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AtteController extends Controller
{
    public function store(Request $request)
    {
        $post=new User();
        $post->name=$request->name;
        //$post->user_id=auth()->user()->id;
        $post->save();
        return view('stamp');
    }

    public function login()
    {
        return view('login');
    }
    
    public function register()
    {
        return view('register');
    }

    public function stamp(Request $request)
    {
        $users = $request->only(['name']);
        return view('stamp', compact('users'));
    }

    public function date()
    {
        //$contact = $request->only('id,user_id');//
        $users = user::Paginate(4);
        return view('date', ['users' => $users]);
    }
}
