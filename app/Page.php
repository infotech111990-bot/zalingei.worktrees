<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'page';
    protected $guarded = [];

    public function parent(){
        return $this->belongsTo('App\Page','parent_id');
    }

    public function attachments(){
        return $this->hasMany('App\PageAttachment', 'page_id', 'id');
    }

    public function children(){
        return $this->hasMany('App\Page', 'parent_id', 'id')->where('publish',1)->orderBy('order','ASC');
    }

    public function hasChild(){
        if($this->children->count() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function getLink(){
        if($this->link != null){
            return url($this->link);
        }else{
            return url('page/'.$this->id.'/'.\Illuminate\Support\Str::slug($this->titleEn));
        }
    }

    public function subMenu(){
        $parent_id = $this->parent_id;
        $subMenu = Page::where('id', $parent_id)->get();
        return $subMenu;
    }

    function getPicture(){
        if($this->picture){
            return asset('includes/headers/'.$this->picture);
        }

        return asset('assets/images/_smarty/noimage.jpg');
    }

}
