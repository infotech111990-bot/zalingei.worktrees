<?php

namespace App;

use App\College;
use Illuminate\Database\Eloquent\Model;

class CollegesType extends Model {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'colleges_types';

	public function colleges($orderBy = null){
		$colleges = $this->hasMany(College::class);
		if(isset($orderBy)){
			$colleges = $colleges->orderBy('$orderBy');
		}
		return $colleges;
	}

	
}
