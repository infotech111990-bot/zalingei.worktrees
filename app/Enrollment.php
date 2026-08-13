<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Enrollment extends Model
{
    protected $guarded = [];
    public function student() { return $this->belongsTo(Student::class); }
    public function course() { return $this->belongsTo(Course::class); }
    public function semester() { return $this->belongsTo(Semester::class); }
}
