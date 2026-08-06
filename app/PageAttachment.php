<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageAttachment extends Model
{
    protected $table = 'page_attachments';

    protected $guarded = [];
    public function page(){
        return $this->belongsTo('App\Page','page_id');
    }

    // public function getFileUrl(){
    //     return \request()->root().$this->file;
    // }


    // public function getPicture(){
    //     $includes = request()->root().'/public/includes/pages';
    //     return $includes.'/'.$this->file;
    // }

     function getPicture(){
        if($this->picture){
            return asset('includes/pageAttachments/'.$this->picture);
        }

        return asset('assets/images/_smarty/noimage.jpg');
    }
 
    function getPdf(){
        if($this->url){
            return asset('includes/pageAttachments/'.$this->url);
        }

        return '';
    }
}
