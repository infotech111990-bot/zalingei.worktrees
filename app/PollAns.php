<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollAns extends Model
{
    protected $table = "pollans";
    protected $fillable = ['poll_id','title','titleEn'];
    //protected $primaryKey = 'ansNo';

    public function poll()
    {
        return $this->belongsTo('App\Poll');
    }

    public function getPercent(){
        $total = PollAns::where('poll_id',$this->poll->id)->sum('count');
        if($total > 0){
            $percent = round(( $this->count / $total ) * 100);
        }else{
            $percent = 0;
        }
        return $percent;
    }

    public function getGrids(){
        $count = $total = PollAns::where('poll_id',$this->poll->id)->count();
        $grids = 12 / $count;
        return $grids;
    }
}