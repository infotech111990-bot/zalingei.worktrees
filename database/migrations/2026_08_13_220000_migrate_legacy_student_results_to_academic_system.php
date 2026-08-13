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

        // Preserve existing student data. Only fill the known CSIT college for the legacy demo record.
        if (Schema::hasTable('students') && Schema::hasTable('college') && Schema::hasColumn('students', 'college_id')) {
            $collegeId = DB::table('college')->where('slug', 'csit')->value('id');
            if ($collegeId) {
                DB::table('students')->where('student_number', '20231234')->whereNull('college_id')->update([
                    'college_id' => $collegeId,
                    'updated_at' => now(),
                ]);
            }
        }

        $legacy = DB::table('student_results')->select(
            'id', 'student_number', 'subject_name', 'marks', 'grade', 'semester', 'academic_year'
        )->orderBy('id')->get();

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
            $semesterNumber = $semesterNumber ?: 1;
            $semesterCode = 'LEGACY-' . substr(sha1($yearName . '|' . $semesterSource), 0, 12);

            $semesterQuery = DB::table('semesters')->where('academic_year_id', $yearId);
            if (Schema::hasColumn('semesters', 'code')) {
                $semesterId = (clone $semesterQuery)->where('code', $semesterCode)->value('id');
            } else {
                $semesterId = (clone $semesterQuery)->where('term', $semesterNumber)->value('id');
            }

            if (!$semesterId) {
                $semesterData = [
                    'academic_year_id' => $yearId,
                    'name' => 'Semester ' . $semesterNumber,
                    'is_current' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                if (Schema::hasColumn('semesters', 'code')) {
                    $semesterData['code'] = $semesterCode;
                }
                if (Schema::hasColumn('semesters', 'term')) {
                    $semesterData['term'] = $semesterNumber;
                }
                $semesterId = DB::table('semesters')->insertGetId($semesterData);
            }

            $studentId = DB::table('students')->where('student_number', $result->student_number)->value('id');
            if (!$studentId) {
                continue;
            }

            $subject = trim((string) $result->subject_name) ?: ('Legacy Course ' . $result->id);
            $courseCode = 'LEGACY-' . substr(sha1($subject), 0, 12);
            $courseId = DB::table('courses')->where('code', $courseCode)->value('id');

            if (!$courseId) {
                $courseData = [
                    'department_id' => Schema::hasColumn('courses', 'department_id') ? DB::table('students')->where('id', $studentId)->value('department_id') : null,
                    'code' => $courseCode,
                    'credit_hours' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                if (Schema::hasColumn('courses', 'name')) {
                    $courseData['name'] = 'Legacy Course ' . $result->id;
                }
                if (Schema::hasColumn('courses', 'name_en')) {
                    $courseData['name_en'] = 'Legacy Course ' . $result->id;
                }
                if (Schema::hasColumn('courses', 'name_ar')) {
                    $courseData['name_ar'] = $subject;
                }
                if (Schema::hasColumn('courses', 'active')) {
                    $courseData['active'] = true;
                }
                if (Schema::hasColumn('courses', 'is_active')) {
                    $courseData['is_active'] = true;
                }
                $courseId = DB::table('courses')->insertGetId($courseData);
            }

            $total = is_numeric($result->marks) ? (float) $result->marks : null;
            $letterGrade = strtoupper(trim((string) $result->grade));
            $points = $this->gradePoints($letterGrade);

            DB::table('enrollments')->updateOrInsert(
                ['student_id' => $studentId, 'course_id' => $courseId, 'semester_id' => $semesterId],
                ['status' => 'completed', 'updated_at' => now(), 'created_at' => now()]
            );

            $gradeData = [
                'midterm' => null,
                'final' => null,
                'practical' => null,
                'total_score' => $total,
                'letter_grade' => $letterGrade ?: null,
                'grade_points' => $points,
                'updated_at' => now(),
            ];
            if (Schema::hasColumn('grades', 'remarks')) {
                $gradeData['remarks'] = 'Migrated from legacy student_results record #' . $result->id;
            }

            DB::table('grades')->updateOrInsert(
                ['student_id' => $studentId, 'course_id' => $courseId, 'semester_id' => $semesterId],
                $gradeData + ['created_at' => now()]
            );
        }
    }

    private function semesterNumber(string $source): ?int
    {
        $source = strtolower($source);
        if (preg_match('/(?:semester|term|الفصل|الترم)\s*([12])/u', $source, $match)) {
            return max(1, min(2, (int) $match[1]));
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
        // Non-destructive by design: legacy results remain intact.
    }
};
