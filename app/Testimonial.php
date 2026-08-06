<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $table = 'testimonial';

    function getPicture(){
        if($this->picture){
            return asset('includes/testimonial/'.$this->picture);
        }

        return asset('assets/images/_smarty/noimage.jpg');
    }

}
