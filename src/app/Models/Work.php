<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    /*protected $guarded = array('id');
    public static $rules = array(
        'user_id' => 'required',
        'date' => 'required',
        'start_time' => 'required',
        'end_time' => 'required',
    );

    public function getTitle(){
        return 'ID'.$this->id . ':' . $this->date .':' . $this->start_time . ':' . $this->end_time;
    }*/
}
