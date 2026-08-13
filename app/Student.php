<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Student extends Model
{
    protected $table = 'students';
    protected $guarded = [];
    public function user(){ return $this->belongsTo(User::class); }
    public function college(){ return $this->belongsTo(College::class, 'college_id'); }
    public function department(){ return $this->belongsTo(CollegesDepartments::class, 'department_id'); }
    public function results(){ return $this->hasMany(StudentResult::class, 'student_number', 'student_number'); }
    public function enrollments(){ return $this->hasMany(Enrollment::class); }
    public function grades(){ return $this->hasMany(Grade::class); }
    public function calculateGPA($semesterId = null)
    {
        $query = $this->grades()->with('course');
        if ($semesterId) $query->where('semester_id', $semesterId);
        $grades = $query->get();
        $hours = 0; $points = 0;
        foreach ($grades as $grade) {
            $hours += (int) ($grade->course->credit_hours ?? 0);
            $points += (float) ($grade->grade_points ?? 0) * (int) ($grade->course->credit_hours ?? 0);
        }
        return $hours > 0 ? round($points / $hours, 2) : 0.00;
    }
}
