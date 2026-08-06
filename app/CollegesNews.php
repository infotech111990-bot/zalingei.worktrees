<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollegesNews extends Model {


   protected $guarded = [];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'colleges_news';
	

	public function getNewsImage(){ 
		if(!empty($this->newsPicture)){
			$publicPath = public_path('includes/colleges/news/'.$this->colNo.'/'.$this->newsPicture);
			if(file_exists($publicPath)){
				return asset('includes/colleges/news/'.$this->colNo.'/'.$this->newsPicture);
			}
		}

		return asset('includes/colleges/news/noNewsFound.jpg');
	}
    
    public function college(){
        $college = $this->belongsTo(College::class);
        return $college;
    }

    public function language(){
        $language = $this->belongsTo('Languages','newsLanguage');
        return $language;
    }

    public function getPicture(){
        if($this->picture && isset($this->college->id)){
            return asset('includes/colleges/'.$this->college->id.'/news/'.$this->picture);
        }

        return asset('assets/images/_smarty/noimage.jpg');
    }

	
}