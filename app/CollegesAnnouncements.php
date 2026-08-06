<?php

namespace App;

use App\College;
use Illuminate\Database\Eloquent\Model;

class CollegesAnnouncements extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'colleges_announcements';
	protected $guarded = [];
	

	public function getPicture(){ 
		if(!empty($this->picture)){
			$imagePath = public_path('includes/colleges/news/'.$this->colNo.'/'.$this->picture);
			if(file_exists($imagePath)){
				return asset('includes/colleges/news/'.$this->colNo.'/'.$this->picture);
			}
		}

		return asset('assets/images/_smarty/noimage.jpg');
	}
    
    public function college(){
        $college = $this->belongsTo(College::class);
        return $college;
	}
	
	public function getUrl(){
		return $this->college->getUrl()."/announcements/".$this->id;
	}

}