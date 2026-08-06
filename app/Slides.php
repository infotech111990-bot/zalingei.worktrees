<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Slides extends Model
{

    protected $fillable = [
        'template',
        'lang',
        'headerOne',
        'headerTwo',
        'txtOne',
        'txtTwo',
        'lineOne',
        'lineTwo',
        'lineThree',
        'lineFour',
        'lineFive',
        'lineSix',
        'start_at',
        'end_at',
        'LinkOneTitle',
        'linkOneUrl',
        'linkTwoTitle',
        'linkTwoUrl',
        'views',
        'picture',
        'publish'
    ];

    public static function getSlides(){
        $lang = \Lang::get('site.getContent',['ar' => 1, 'en' => 2]);
        $slides = Slides::whereRaw('NOW() BETWEEN start_at AND end_at')
                        ->where('lang', $lang)
                        ->where('publish',1)
                        ->orderBy('template','asc')
                        ->orderByRaw('rand()')
                        ->get();
        return $slides;
    }

    public function getPicture(){
        $includes = trim(\Config::get('mtcpanel.slidesPath'), '/');
        if($this->picture){
            return asset($includes.'/'.$this->picture);
        }

        return asset('assets/images/_smarty/noimage.jpg');
    }

    public function getIcon(){
        $includes = trim(\Config::get('mtcpanel.slidesIconPath'), '/');
        if($this->icon){
            return asset($includes.'/'.$this->icon);
        }

        return asset('assets/images/_smarty/noimage.jpg');
    }

    public function getBackGround(){
        $includes = trim(\Config::get('mtcpanel.slidesPath'), '/');
        if($this->backGround){
            return asset($includes.'/'.$this->backGround);
        }

        return asset('assets/images/_smarty/noimage.jpg');
    }

}