<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Grade extends Model
{
    protected $guarded = [];
    protected $casts = ['midterm'=>'float','final'=>'float','practical'=>'float','total_score'=>'float','grade_points'=>'float'];
    public function student() { return $this->belongsTo(Student::class); }
    public function course() { return $this->belongsTo(Course::class); }
    public function semester() { return $this->belongsTo(Semester::class); }
}
