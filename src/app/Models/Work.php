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

    protected $guarded = array('id');
    public static $rules = array(
        'user_id' => 'required',
        'work_start' => 'required',
        'work_end' => 'required',
        'work_date' => 'required',
    );

    public function getWork_start(){
        return 'ID'.$this->id . ':' .  $this->work_start;
    }
    public function getWork_end(){
        return 'ID'.$this->id . ':' .  $this->work_end;
    }
    public function getWork_date(){
        return 'ID'.$this->id . ':' .  $this->work_date;
    }
    public function getDetail()
    {
        return [
            'work_start' => $this->work_start,
        ];
    }
}
