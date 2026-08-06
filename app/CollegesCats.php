<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollegesCats extends Model {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'colleges_cats';

	
	
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	
	protected $primaryKey='colCatNo';
	
}
