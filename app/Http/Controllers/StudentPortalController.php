<?php

namespace App\Http\Controllers;

use App\Student;
use App\StudentResult;
use App\College;
use App\CollegesDepartments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class StudentPortalController extends Controller
{
    /**
     * Show the student portal landing page.
     */
    public function index()
    {
        $colleges = College::orderBy('name_ar', 'asc')->get();
        $departments = Schema::hasTable('dept')
            ? CollegesDepartments::orderBy('title', 'asc')->get()
            : collect();

        return view('site.studentPortal', compact('colleges', 'departments'));
    }

    /**
     * Student registration form.
     */
    public function registerForm()
    {
        $colleges = College::orderBy('name_ar', 'asc')->get();
        $departments = Schema::hasTable('dept')
            ? CollegesDepartments::orderBy('title', 'asc')->get()
            : collect();

        return view('site.studentRegister', compact('colleges', 'departments'));
    }

    /**
     * Store a new student registration.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'student_number' => [
                'required',
                'string',
                'max:50',
                Rule::unique('students', 'student_number'),
            ],
            'national_id'   => 'nullable|string|max:50',
            'name_ar'       => 'required|string|max:255',
            'name_en'       => 'nullable|string|max:255',
            'email'         => 'nullable|email|max:191',
            'phone'         => 'nullable|string|max:50',
            'college_id'    => 'nullable|integer|exists:college,id',
            'department_id' => [
                'nullable',
                'integer',
                'exists:dept,id',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value && $request->filled('college_id')) {
                        $belongsToCollege = CollegesDepartments::whereKey($value)
                            ->where('college_id', $request->college_id)
                            ->exists();

                        if (!$belongsToCollege) {
                            $fail(__('site.getContent', [
                                'ar' => 'القسم المختار لا يتبع الكلية المحددة.',
                                'en' => 'The selected department does not belong to the selected college.',
                            ]));
                        }
                    }
                },
            ],
            'academic_year' => 'nullable|string|max:20',
        ]);

        Student::create($validated);

        return redirect()->route('student.portal')
            ->with('success', __('site.getContent', [
                'ar' => 'تم تسجيل الطالب بنجاح!',
                'en' => 'Student registered successfully!',
            ]));
    }

    /**
     * Look up a student's results by their student number.
     */
    public function results(Request $request)
    {
        $studentNumber = $request->input('student_number');
        $student = null;
        $results = collect();

        if ($studentNumber) {
            $student = Student::where('student_number', $studentNumber)->first();

            if ($student) {
                $results = StudentResult::where('student_number', $studentNumber)
                    ->orderBy('semester', 'asc')
                    ->orderBy('subject_name', 'asc')
                    ->get();
            }
        }

        return view('site.studentResults', compact('student', 'results', 'studentNumber'));
    }
}
