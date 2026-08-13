<?php

namespace App\Http\Controllers;

use App\AcademicYear;
use App\Semester;
use App\Course;
use App\Enrollment;
use App\Grade;
use App\Student;
use App\CollegesDepartments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class AcademicManagementController extends Controller
{
    public function index()
    {
        return view('site.student.academic-management.index', [
            'academicYears' => AcademicYear::withCount('semesters')->orderByDesc('id')->get(),
            'courses' => Course::with('department')->withCount('enrollments')->orderBy('code')->get(),
            'students' => Student::where('status', 1)->orderBy('student_number')->get(['id','student_number','name_ar','name_en']),
            'departments' => Schema::hasTable('dept') ? CollegesDepartments::orderBy('title')->get() : collect(),
        ]);
    }

    public function storeAcademicYear(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'name_ar' => 'nullable|string|max:100',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'nullable|boolean',
        ]);
        $data['status'] = true;
        $data['is_current'] = (bool) ($data['is_current'] ?? false);
        if ($data['is_current']) AcademicYear::where('is_current', true)->update(['is_current' => false]);
        AcademicYear::create($data);
        return back()->with('success', 'Academic year created successfully.');
    }

    public function storeSemester(Request $request)
    {
        $data = $request->validate([
            'academic_year_id' => 'required|exists:academic_years,id',
            'name' => 'required|string|max:50',
            'name_ar' => 'nullable|string|max:100',
            'semester_number' => 'required|integer|min:1|max:3',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'nullable|boolean',
        ]);
        $data['status'] = true;
        $data['is_current'] = (bool) ($data['is_current'] ?? false);
        if ($data['is_current']) Semester::where('is_current', true)->update(['is_current' => false]);
        Semester::create($data);
        return back()->with('success', 'Semester created successfully.');
    }

    public function storeCourse(Request $request)
    {
        $data = $request->validate([
            'department_id' => 'nullable|exists:dept,id',
            'code' => 'required|string|max:50|unique:courses,code',
            'name' => 'required|string|max:255',
            'name_ar' => 'nullable|string|max:255',
            'credit_hours' => 'required|integer|min:1|max:20',
        ]);
        $data['status'] = true;
        Course::create($data);
        return back()->with('success', 'Course created successfully.');
    }

    public function storeEnrollment(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'semester_id' => 'required|exists:semesters,id',
            'status' => 'required|string|max:30',
        ]);
        Enrollment::updateOrCreate(
            ['student_id' => $data['student_id'], 'course_id' => $data['course_id'], 'semester_id' => $data['semester_id']],
            ['status' => $data['status']]
        );
        return back()->with('success', 'Student enrollment saved successfully.');
    }

    public function storeGrade(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'semester_id' => 'required|exists:semesters,id',
            'midterm' => 'nullable|numeric|min:0|max:100',
            'final' => 'nullable|numeric|min:0|max:100',
            'practical' => 'nullable|numeric|min:0|max:100',
            'total_score' => 'nullable|numeric|min:0|max:100',
            'letter_grade' => 'nullable|string|max:5',
            'grade_points' => 'nullable|numeric|min:0|max:4',
            'remarks' => 'nullable|string',
        ]);
        $grade = Grade::updateOrCreate(
            ['student_id' => $data['student_id'], 'course_id' => $data['course_id'], 'semester_id' => $data['semester_id']],
            collect($data)->except(['student_id','course_id','semester_id'])->all()
        );
        return back()->with('success', 'Grade saved successfully.');
    }
}
