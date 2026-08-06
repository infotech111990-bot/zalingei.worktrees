<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    protected $guarded = [];
    
    public function getPicture(){
        if($this->picture){
            return asset('includes/services/'.$this->picture);
        }

        return asset('assets/images/_smarty/noimage.jpg');
    }
    
    public function getLink(){
        if($this->link != null){
            return url($this->link);
        }else{
            return url('services/'.$this->id);
        }
    }
    
    public function getIcon(){
        if($this->icon){
            return asset('includes/services/icons/'.$this->icon);
        }

        return asset('assets/images/_smarty/noimage.jpg');
    }

}
