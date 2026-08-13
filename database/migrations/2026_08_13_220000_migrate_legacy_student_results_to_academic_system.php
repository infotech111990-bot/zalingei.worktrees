<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('student_results') || !Schema::hasTable('academic_years') || !Schema::hasTable('semesters') || !Schema::hasTable('courses') || !Schema::hasTable('enrollments') || !Schema::hasTable('grades')) {
            return;
        }

        // Preserve the existing student record and associate the known sample
        // student with the existing Computer Science and Information Technology college.
        if (Schema::hasTable('students') && Schema::hasTable('college')) {
            $collegeId = DB::table('college')->where('slug', 'csit')->value('id') ?: 7;
            DB::table('students')
                ->where('student_number', '20231234')
                ->whereNull('college_id')
                ->update([
                    'college_id' => $collegeId,
                    'updated_at' => now(),
                ]);
        }

        $legacy = DB::table('student_results')
            ->select('id', 'student_number', 'subject_name', 'marks', 'grade', 'semester', 'academic_year')
            ->orderBy('id')
            ->get();

        $semesterNumbers = [];

        foreach ($legacy as $result) {
            $yearName = trim((string) $result->academic_year) ?: 'Unknown Academic Year';

            $yearId = DB::table('academic_years')->where('name', $yearName)->value('id');
            if (!$yearId) {
                $yearId = DB::table('academic_years')->insertGetId([
                    'name' => $yearName,
                    'name_ar' => null,
                    'start_date' => null,
                    'end_date' => null,
                    'is_current' => false,
                    'status' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $semesterSource = trim((string) $result->semester);
            $semesterKey = $yearName . '|' . $semesterSource;
            $semesterNumber = $this->semesterNumber($semesterSource);

            if ($semesterNumber === null) {
                $semesterNumbers[$yearName] ??= [];
                if (!array_key_exists($semesterSource, $semesterNumbers[$yearName])) {
                    $semesterNumbers[$yearName][$semesterSource] = count($semesterNumbers[$yearName]) + 1;
                }
                $semesterNumber = min(3, $semesterNumbers[$yearName][$semesterSource]);
            }

            $semesterCode = 'LEGACY-' . substr(sha1($semesterKey), 0, 12);
            $semesterId = DB::table('semesters')
                ->where('academic_year_id', $yearId)
                ->where('code', $semesterCode)
                ->value('id');

            if (!$semesterId) {
                $semesterId = DB::table('semesters')->insertGetId([
                    'academic_year_id' => $yearId,
                    'name' => 'Semester ' . $semesterNumber,
                    'name_ar' => null,
                    'semester_number' => $semesterNumber,
                    'start_date' => null,
                    'end_date' => null,
                    'is_current' => false,
                    'status' => true,
                    'code' => $semesterCode,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $subject = trim((string) $result->subject_name) ?: ('Legacy Course ' . $result->id);
            $courseCode = 'LEGACY-' . substr(sha1($subject), 0, 12);
            $courseId = DB::table('courses')->where('code', $courseCode)->value('id');

            if (!$courseId) {
                $courseId = DB::table('courses')->insertGetId([
                    'department_id' => null,
                    'code' => $courseCode,
                    'name' => 'Legacy Course ' . $result->id,
                    'name_ar' => $subject,
                    'credit_hours' => 3,
                    'status' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $studentId = DB::table('students')
                ->where('student_number', $result->student_number)
                ->value('id');

            if (!$studentId) {
                continue;
            }

            $total = is_numeric($result->marks) ? (float) $result->marks : null;
            $grade = strtoupper(trim((string) $result->grade));
            $points = $this->gradePoints($grade);

            if (!DB::table('enrollments')
                ->where('student_id', $studentId)
                ->where('course_id', $courseId)
                ->where('semester_id', $semesterId)
                ->exists()) {
                DB::table('enrollments')->insert([
                    'student_id' => $studentId,
                    'course_id' => $courseId,
                    'semester_id' => $semesterId,
                    'status' => 'completed',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            if (!DB::table('grades')
                ->where('student_id', $studentId)
                ->where('course_id', $courseId)
                ->where('semester_id', $semesterId)
                ->exists()) {
                DB::table('grades')->insert([
                    'student_id' => $studentId,
                    'course_id' => $courseId,
                    'semester_id' => $semesterId,
                    'midterm' => null,
                    'final' => null,
                    'practical' => null,
                    'total_score' => $total,
                    'letter_grade' => $grade ?: null,
                    'grade_points' => $points,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    private function semesterNumber(string $source): ?int
    {
        $source = strtolower($source);
        if (preg_match('/(?:semester|term|الفصل|الترم)\s*([123])/u', $source, $match)) {
            return max(1, min(3, (int) $match[1]));
        }

        return null;
    }

    private function gradePoints(string $grade): float
    {
        return match ($grade) {
            'A+', 'A' => 4.00,
            'A-' => 3.70,
            'B+' => 3.50,
            'B' => 3.00,
            'B-' => 2.70,
            'C+' => 2.50,
            'C' => 2.00,
            'C-' => 1.70,
            'D+' => 1.50,
            'D' => 1.00,
            'F' => 0.00,
            default => 0.00,
        };
    }

    public function down(): void
    {
        // Non-destructive: legacy student_results records are never removed.
    }
};
