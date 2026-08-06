<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollegeDetails extends Model {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $guarded  = [];

	protected $table = 'college_details';



	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */


	public function college(){
		return $this->belongsTo(College::class);
	}	

}
