<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentResult extends Model
{
    protected $table = 'student_results';
    protected $guarded = [];

    public function student(){
        return $this->belongsTo(Student::class, 'student_number', 'student_number');
    }
}