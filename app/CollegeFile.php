<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollegeFile extends Model {


   protected $guarded = [];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'college_files';
	
    
    public function college(){

        return  $this->belongsTo(Colleges::class);
        
    }

    public function language(){
        $language = $this->belongsTo('Languages','newsLanguage');
        return $language;
    }

	
}