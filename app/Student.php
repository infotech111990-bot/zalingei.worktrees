<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $guarded = [];

    public function college(){
        return $this->belongsTo(College::class, 'college_id');
    }

    public function department(){
        return $this->belongsTo(CollegesDepartments::class, 'department_id');
    }

    public function results(){
        return $this->hasMany(StudentResult::class, 'student_number', 'student_number');
    }
}