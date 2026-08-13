<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Course extends Model
{
    protected $guarded = [];
    public function department() { return $this->belongsTo(CollegesDepartments::class, 'department_id'); }
    public function grades() { return $this->hasMany(Grade::class); }
    public function enrollments() { return $this->hasMany(Enrollment::class); }
}
