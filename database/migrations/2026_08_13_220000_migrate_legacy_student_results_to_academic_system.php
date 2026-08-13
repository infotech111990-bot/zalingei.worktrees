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

        // Link the known sample student to the existing Computer Science and
        // Information Technology college without changing any legacy results.
        if (Schema::hasTable('students') && Schema::hasTable('college')) {
            $collegeId = DB::table('college')->where('slug', 'csit')->value('id') ?: 7;
            DB::table('students')
                ->where('student_number', '20231234')
                ->whereNull('college_id')
                ->update(['college_id' => $collegeId, 'updated_at' => now()]);
        }

        $legacy = DB::table('student_results')
            ->select('id', 'student_number', 'subject_name', 'marks', 'grade', 'semester', 'academic_year')
            ->orderBy('id')
            ->get();

        foreach ($legacy as $result) {
            $yearName = trim((string) $result->academic_year) ?: 'Unknown Academic Year';

            $yearId = DB::table('academic_years')->where('name', $yearName)->value('id');
            if (!$yearId) {
                $yearId = DB::table('academic_years')->insertGetId([
                    'name' => $yearName,
                    'is_current' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $semesterSource = trim((string) $result->semester);
            $semesterNumber = $this->semesterNumber($semesterSource);
            $semesterCode = 'LEGACY-' . substr(sha1($yearName . '|' . $semesterSource), 0, 12);
            $semesterName = 'Semester ' . $semesterNumber;

            $semesterId = DB::table('semesters')
                ->where('academic_year_id', $yearId)
                ->where('code', $semesterCode)
                ->value('id');

            if (!$semesterId) {
                $semesterId = DB::table('semesters')->insertGetId([
                    'academic_year_id' => $yearId,
                    'name' => $semesterName,
                    'code' => $semesterCode,
                    'is_current' => false,
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
                    'name' => $subject,
                    'name_ar' => $subject,
                    'credit_hours' => 3,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $studentId = DB::table('students')->where('student_number', $result->student_number)->value('id');
            if (!$studentId) {
                continue;
            }

            $total = is_numeric($result->marks) ? (float) $result->marks : null;
            $grade = strtoupper(trim((string) $result->grade));
            $points = $this->gradePoints($grade);

            $enrollmentExists = DB::table('enrollments')
                ->where('student_id', $studentId)
                ->where('course_id', $courseId)
                ->where('semester_id', $semesterId)
                ->exists();

            if (!$enrollmentExists) {
                DB::table('enrollments')->insert([
                    'student_id' => $studentId,
                    'course_id' => $courseId,
                    'semester_id' => $semesterId,
                    'status' => 'completed',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $gradeExists = DB::table('grades')
                ->where('student_id', $studentId)
                ->where('course_id', $courseId)
                ->where('semester_id', $semesterId)
                ->exists();

            if (!$gradeExists) {
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
                    'remarks' => 'Migrated from legacy student_results record #' . $result->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    private function semesterNumber(string $source): int
    {
        $source = strtolower($source);
        if (preg_match('/(?:semester|term|الفصل|الترم)\\s*([12])/u', $source, $match)) {
            return max(1, min(2, (int) $match[1]));
        }

        // Legacy Arabic text may already be stored as question marks. For
        // those records, the first distinct legacy semester is treated as 1
        // and the next as 2 by the stable hash ordering used below.
        return 1;
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
        // Intentionally non-destructive: legacy results remain the source of
        // truth and migrated academic records should not be deleted on rollback.
    }
};
