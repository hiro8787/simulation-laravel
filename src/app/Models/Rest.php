<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
    use HasFactory;

    public function getUserNameById()
    {
        return DB::table('rests')
            ->join('works', 'rests.work_id', '=', 'works.user_id')
            ->get();
    }

    protected $fillable = [
        'work_id',
        'rest_start',
        'rest_end',
        'rest_time'
    ];

    public function work()
    {
        return $this->belongsTo('Work::class');
    }
}
/*
    protected $guarded = array('id');
    public static $rules = array(
        'work_id' => 'required',
        'rest_start' => 'required',
        'rest_end' => 'required',
        'rest_time' => 'required',
    );

    public function getRest_start(){
        return 'ID'.$this->id . ':' .  $this->rest_start;
    }
    public function getRest_end(){
        return 'ID'.$this->id . ':' .  $this->rest_end;
    }
    public function getRest_time(){
        return 'ID'.$this->id . ':' .  $this->rest_time;
    }
}
*/