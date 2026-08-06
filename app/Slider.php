<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Slider extends Model
{
    protected $table = 'slider';

    protected $fillable = ['lang','text1','text2','text3','picture','startDate','endDate','url','status'];

    public static function getSliders(){
        $sliders = Slider::whereRaw('NOW() BETWEEN startDate AND endDate')
                        ->where('lang',(Session::get('langID'))?Session::get('langID'):1)
                        ->where('status',1)
                        ->orderByRaw('rand()')
                        ->get();
        return $sliders;
    }

    public function getPicture(){
        $includes = trim(\Config::get('mtcpanel.sliderPath'), '/');
        if($this->picture){
            return asset($includes.'/'.$this->picture);
        }
        return asset('assets/images/_smarty/noimage.jpg');
    }

}