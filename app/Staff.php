<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'staff'; 
	protected $guarded = [];



	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */


	protected $primaryKey='id';

	public function college(){
		return $this->belongsTo(College::class,'college_id');
	}

	public function dept(){
		return $this->belongsTo(CollegesDepartments::class,'dept_id');
	}

	public function degree(){
		return $this->belongsTo(StaffDegree::class,'staff_degree_id');
	}

	public function gender(){
		return $this->belongsTo(Gender::class);
	}

	public function getUrl(){
		return route('staffDetails',[$this->id,\Illuminate\Support\Str::slug($this->nameEn)]);
	}

	public function department(){
		return $this->belongsTo(CollegesDepartments::class,'dept_id');
	}

	public function getStaffDept(){
		$staff = Staff::find($this->id);
		$dept_id = $staff->dept_id;
		$dept = CollegesDepartments::find($dept_id);
		if(isset($dept->title)){
			return Lang::get('site.getContent',['ar'=>$dept->title, 'en'=>$dept->deptTitleEn]);
        }else{
            return null;
        }
	}

	public function getStaffdept_id(){
		$staff = Staff::find($this->id);
		$college_id = $staff->college_id;
		$dept_id = $staff->dept_id;
		$dept = CollegesDepartments::where('college_id','=',$college_id)->where('dept_id','=',$dept_id)->first();
		if(isset($dept->dept_id)){
			return $dept->dept_id;
        }else{
            return null;
        }
	}

	public function getStaffCol(){
		$staff = Staff::find($this->id);
		$college_id = $staff->college_id;
		$college_id = $staff->college_id;
		$col = College::where('college_id','=',$college_id)->first();
		if(isset($col->colTitle)){
			return Lang::get('site.getContent',['ar'=>$col->colTitle, 'en'=>$col->colTitleEn]);
        }else{
            return null;
        }
	}

	public function getStaffGender(){
		$staffGender = $this->staffGender;
		if($staffGender == 1){
			return Lang::get('site.getContent',['ar'=>'ذكر', 'en'=>'Male']);
        }else{
			return Lang::get('site.getContent',['ar'=>'أنثى', 'en'=>'Female']);
        }
	}

    public function getPicture(){
		if($this->picture){
			return asset('includes/staff/'.$this->picture);
		}

		return asset('includes/staff/no-picture.gif');
    }

    public function getStaffDegree(){
		$degree = $this->degree;
        if(isset($degree)){
			return \Lang::get('site.getContent',['ar'=>$degree->title, 'en'=>$degree->titleEn]);
        }
    }

	public function getStaffDetails(){
		return $this->hasMany('StaffDetails','id');
	}

	
	public function trans($ar = null, $en = null){
		return \Lang::get('site.getContent', ['ar'=>$this->$ar, 'en'=>$this->$en]);
	}

	public function details(){
		return $this->hasMany(StaffDetails::class);
	}

}
