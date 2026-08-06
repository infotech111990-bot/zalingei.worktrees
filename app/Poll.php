<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $guarded = [];

    public function answers(){
      return $this->hasMany(PollAns::class);
    }
}
