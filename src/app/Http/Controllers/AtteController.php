<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AtteController extends Controller
{
    public function index()
    {
        return view('login');
    }
    
    public function register()
    {
        return view('register');
    }

    public function stamp()
    {
        return view('stamp');
    }

    public function date()
    {
        return view('date');
    }
}
