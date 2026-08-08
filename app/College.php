<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class College extends Model {

    protected $guarded  = [];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'college'; 

	
	
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	
	public function type(){
		return $this->belongsTo(CollegesType::class,'colleges_type_id');
	}

	function departments(){
		return $this->hasMany(CollegesDepartments::class)->orderBy('title');
	}
	
	function extraDetails(){
		return $this->hasMany(CollegeExtraContent::class);
	}
	
	function details(){
		return $this->hasOne(CollegeDetails::class);
	}

	function hasDetails($var = null){
		$varEn = $var.'En';
		if($this->details && __('site.getContent',['ar' => $this->details->$var, 'en' => $this->details->$varEn])){
			return true;
		}
		return false;
	}
	
	function slider(){
		return $this->hasMany(CollegesSlider::class);
	}
	
	function getPicture(){
		if(!empty($this->picture)){
			$picturePath = public_path('includes/colleges/'.$this->id.'/'.$this->picture);
			if(file_exists($picturePath)){
				return asset('includes/colleges/'.$this->id.'/'.$this->picture);
			}
		}

		return asset('includes/colleges/no-picture.jpg');
	}

	function announcements(){
		return $this->hasMany(CollegesAnnouncements::class)->orderBy('created_at','desc');
	}

	// function getFieldStatus($fName){
	// 	$cDetails = CollegesDetails::where('colNo','=',$this->colNo)->lists($fName);
	// 	$countOfChars = count($cDetails);
	// 	if($countOfChars > 0){
	// 		return "<i class='fa fa-fw fa-lg fa-check-circle text-success'></i>";
	// 	}else{
	// 		return "<i class='fa fa-fw fa-lg fa-times text-danger'></i>";
	// 	}
	// }
    
    // public function getCollegeAdmin(){
    //     //$sectionList = Auth::admin()->user()->getListPriv('colleges');
    //     $admin = array();
    //     $colNo = $this->colNo;
    //     $colleges = AdminPriviliges::where('section','=','colleges')->whereRaw(' FIND_IN_SET('.$colNo.',sectionID) ')->get();
    //     foreach ($colleges as $col){
    //         $admin[] = $col->username;
    //         echo '<a href="#" class="label label-primary" style="margin:0 5px;"><i class="fa fw fa-user"></i> '.$col->username.' </a>';
    //     }
    //     //return true;
    // }
	
	public function getColType(){
		if($this->colType > 0){
			$cat = $this->belongsTo(CollegesCats::class);
			return $cat;
			//return Lang::get('site.getContent',['ar'=>$cat->title,'en'=>$cat->titleEn]);
		}else{
			return "لا يوجد تصنيف";
		}
	}
	
	public function getNews(){
		return $this->hasMany(CollegesNews::class);
	}
	
	public function news(){
		return $this->hasMany(CollegesNews::class);
	}
	

	public function files(){
		return $this->hasMany(CollegeFile::class);
	}
	public function latestNews(){
		return $this->hasMany(CollegesNews::class)->limit(3);
	}
	
	public function professors(){
		return $this->hasMany(Staff::class)->where('is_prof',1);
	}

	public function staff(){
		return $this->hasMany(Staff::class)->with(['degree', 'department'])->orderBy('name');
	}


	public function getUrl(){
		return route('college.display', ['slug' => $this->slug]);
	}
	
}
