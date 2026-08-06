<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffDetails extends Model {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'staff_details';
	protected $guarded = [];

	
	
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	
	// protected $primaryKey='staffdNo';

	public function trans($ar = null, $en = null){
		return \Lang::get('site.getContent', ['ar'=>$this->$ar, 'en'=>$this->$en]);
	}
	
}
