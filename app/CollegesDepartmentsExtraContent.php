<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollegesDepartmentsExtraContent extends Model {

	protected $guarded  = [];
	/**
	 * The database table used by the model.
	 *
	 * @var string 
	 */
	protected $table = 'dept_extra_content';
 
	
	
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	
	protected $primaryKey='id';

	public function department(){
		return $this->belongsTo(CollegesDepartments::class, 'deptID');
	}
	
}
