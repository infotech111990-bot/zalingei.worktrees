<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testamonial extends Model
{
    protected $table = 'testamonials';
    protected $guarded = [];

    function getPicture(){
        if($this->picture){
            return asset('includes/testamonials/'.$this->picture);
        }

        return asset('assets/images/_smarty/noimage.jpg');
    }

}
