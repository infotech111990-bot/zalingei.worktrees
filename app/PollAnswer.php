<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollAnswer extends Model
{
    protected $guarded = [];

    public function poll()
    {
        return $this->belongsTo('App\Poll');
    }

    public function getPercent(){
        $total = PollAnswer::where('poll_id',$this->poll->id)->sum('count');
        if($total > 0){
            $percent = round(( $this->count / $total ) * 100);
        }else{
            $percent = 0;
        }
        return $percent;
    }

    public function getGrids(){
        $count = $total = PollAnswer::where('poll_id',$this->poll->id)->count();
        $grids = 12 / $count;
        return $grids;
    }
}