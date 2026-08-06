<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $guarded = [];

    public function getPicture(){
        if($this->picture){
            return asset('includes/news/'.$this->picture);
        }

        return asset('assets/images/_smarty/noimage.jpg');
    }

    public function getUrl(){
        return url('news/'.$this->id);
    }

    public function trans($feildName){
        return __('site.getContent', ['ar' => $this->$feildName, 'en' => $this->$feildName.'En']);
    }

}