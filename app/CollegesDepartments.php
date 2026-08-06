<?php

namespace App;

use App\College;
use Illuminate\Database\Eloquent\Model;

class CollegesDepartments extends Model {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'dept';

	protected $guarded  = [];

	
	
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	
	//protected $primaryKey='colNo';

	// public function extra(){
	// 	return $this->hasMany(CollegesDepartmentsExtraContent::class);
	// }

	public function college(){
		return $this->belongsTo(College::class,'college_id');
	}
	
	public function getUrl(){
		return $this->college->getUrl()."/dept/".$this->id;
	}

	public function staff(){
		return $this->hasMany(Staff::class,'dept_id');
	}
}
