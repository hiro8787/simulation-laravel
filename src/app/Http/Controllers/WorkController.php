<?php

namespace App\Http\Controllers;
use App\Models\Work;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function stamp(){
        $items = Work::all();
        return view('work.stamp',['items'=>$items]);
    }
    public function create(Request $request){
        $this->validate($request, Work::$rules);
        $form = $request->all();
        Work::create($form);
        return redirect('/stamp');
    }
}
