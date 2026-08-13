<?php
namespace App\Http\Controllers;

use App\Student;
use App\StudentResult;
use App\College;
use App\CollegesDepartments;
use App\AcademicYear;
use App\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class StudentPortalController extends Controller
{
    public function index()
    {
        $colleges = College::where('status', 1)->orderBy('sort_order')->orderBy('name_ar')->get();
        $departments = Schema::hasTable('dept') ? CollegesDepartments::orderBy('title')->get() : collect();
        return view('site.studentPortal', compact('colleges', 'departments'));
    }

    public function registerForm()
    {
        $colleges = College::where('status', 1)->orderBy('sort_order')->orderBy('name_ar')->get();
        $departments = Schema::hasTable('dept') ? CollegesDepartments::orderBy('title')->get() : collect();
        return view('site.studentRegister', compact('colleges', 'departments'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'student_number' => 'required|string|max:50|unique:students,student_number',
            'name_ar' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:191',
            'phone' => 'nullable|string|max:50',
            'national_id' => 'nullable|string|max:50',
            'college_id' => 'required|integer|exists:college,id',
            'department_id' => 'nullable|integer|exists:dept,id',
            'academic_year' => 'nullable|string|max:20',
            'level' => 'nullable|string|max:30',
            'payment_receipt' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $data = $request->except('payment_receipt');
        $data['payment_receipt_path'] = $request->file('payment_receipt')->store('receipts', 'public');
        $data['payment_status'] = 'pending';
        $data['academic_status'] = 'pending';
        $data['status'] = 1;
        Student::create($data);

        return redirect()->route('student.portal')->with('success', 'تم إرسال طلب التسجيل بنجاح. حالة إشعار الدفع: قيد المراجعة. / Registration submitted successfully. Payment receipt: pending review.');
    }

    public function results(Request $request)
    {
        $studentNumber = trim((string) $request->input('student_number'));
        $student = null; $results = collect(); $academicGrades = collect();
        if ($studentNumber !== '') {
            $student = Student::with(['college','department'])->where('student_number', $studentNumber)->first();
            if ($student) {
                $results = StudentResult::where('student_number', $studentNumber)->orderBy('academic_year')->orderBy('semester')->orderBy('subject_name')->get();
                if (Schema::hasTable('grades')) {
                    $academicGrades = $student->grades()->with(['course','semester.academicYear'])->get();
                }
            }
        }
        return view('site.studentResults', compact('student','results','studentNumber','academicGrades'));
    }

    public function dashboard(Request $request)
    {
        $studentNumber = trim((string) $request->input('student_number'));
        abort_if($studentNumber === '', 404);
        $student = Student::with(['college','department'])->where('student_number',$studentNumber)->firstOrFail();
        $grades = Schema::hasTable('grades') ? $student->grades()->with(['course','semester.academicYear'])->get() : collect();
        $semesters = $grades->pluck('semester')->filter()->unique('id')->sortByDesc('id');
        return view('site.student.dashboard', compact('student','grades','semesters'));
    }

    public function transcript(Request $request)
    {
        $studentNumber = trim((string) $request->input('student_number'));
        abort_if($studentNumber === '', 404);
        $student = Student::with(['college','department'])->where('student_number',$studentNumber)->firstOrFail();
        $grades = Schema::hasTable('grades') ? $student->grades()->with(['course','semester.academicYear'])->get() : collect();
        return view('site.student.transcript', compact('student','grades'));
    }

    public function semesters(Request $request)
    {
        $studentNumber = trim((string) $request->input('student_number'));
        abort_if($studentNumber === '', 404);
        $student = Student::where('student_number',$studentNumber)->firstOrFail();
        $semesters = Schema::hasTable('grades') ? $student->grades()->with('semester.academicYear')->get()->pluck('semester')->filter()->unique('id')->sortByDesc('id') : collect();
        return view('site.student.semesters.index', compact('student','semesters'));
    }
}
