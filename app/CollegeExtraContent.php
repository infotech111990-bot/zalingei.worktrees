<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollegeExtraContent extends Model {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'college_extra_content';

	protected $guarded  = [];
	
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	 public function trans($ar = null, $en = null){
		 return \Lang::get('site.getContent',[
			 'ar' => $this->$ar,
			 'en' => $this->$en
		 ]);
	 }

	 public function getPicture(){
		if(!empty($this->picture) && isset($this->college->id)){
			return asset('includes/colleges/'.$this->college->id.'/extraContents/'.$this->picture);
		}

		return asset('includes/staff/no-picture.gif');
	}	
	public function college(){
		return $this->belongsTo(College::class);
	}

	
}
