<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Semester extends Model
{
    protected $guarded = [];
    protected $casts = ['is_current' => 'boolean'];
    public function academicYear() { return $this->belongsTo(AcademicYear::class); }
    public function grades() { return $this->hasMany(Grade::class); }
    public function enrollments() { return $this->hasMany(Enrollment::class); }
}
