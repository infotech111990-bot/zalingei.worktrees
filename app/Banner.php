<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $guarded = [];

    public function getUrl(){
        if($this->url != null){
            return url($this->url);
        }
    }

    function getPicture(){
        if($this->picture){
            return asset('includes/banners/'.$this->picture);
        }

        return asset('assets/images/_smarty/noimage.jpg');
    }

}
