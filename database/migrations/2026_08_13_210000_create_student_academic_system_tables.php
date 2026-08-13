<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('academic_years')) {
            Schema::create('academic_years', function (Blueprint $table) {
                $table->id();
                $table->string('name', 50);
                $table->boolean('is_current')->default(false);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('semesters')) {
            Schema::create('semesters', function (Blueprint $table) {
                $table->id();
                $table->foreignId('academic_year_id')->constrained('academic_years')->cascadeOnDelete();
                $table->string('name', 100);
                $table->string('code', 30)->nullable();
                $table->boolean('is_current')->default(false);
                $table->timestamps();
                $table->index(['academic_year_id', 'name']);
            });
        }

        if (!Schema::hasTable('courses')) {
            Schema::create('courses', function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('department_id')->nullable();
                $table->string('code', 50)->unique();
                $table->string('name', 255);
                $table->string('name_ar', 255)->nullable();
                $table->unsignedTinyInteger('credit_hours')->default(3);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
                $table->index('department_id');
            });
        }

        if (!Schema::hasTable('enrollments')) {
            Schema::create('enrollments', function (Blueprint $table) {
                $table->id();
                $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
                $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
                $table->foreignId('semester_id')->constrained('semesters')->cascadeOnDelete();
                $table->string('status', 20)->default('enrolled');
                $table->timestamps();
                $table->unique(['student_id', 'course_id', 'semester_id']);
            });
        }

        if (!Schema::hasTable('grades')) {
            Schema::create('grades', function (Blueprint $table) {
                $table->id();
                $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
                $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
                $table->foreignId('semester_id')->constrained('semesters')->cascadeOnDelete();
                $table->decimal('midterm', 5, 2)->nullable();
                $table->decimal('final', 5, 2)->nullable();
                $table->decimal('practical', 5, 2)->nullable();
                $table->decimal('total_score', 5, 2)->nullable();
                $table->string('letter_grade', 5)->nullable();
                $table->decimal('grade_points', 4, 2)->nullable();
                $table->timestamps();
                $table->unique(['student_id', 'course_id', 'semester_id']);
                $table->index(['student_id', 'semester_id']);
            });
        }

        if (Schema::hasTable('students')) {
            Schema::table('students', function (Blueprint $table) {
                if (!Schema::hasColumn('students', 'payment_receipt_path')) $table->string('payment_receipt_path')->nullable();
                if (!Schema::hasColumn('students', 'payment_status')) $table->string('payment_status', 20)->default('pending');
                if (!Schema::hasColumn('students', 'academic_status')) $table->string('academic_status', 30)->default('pending');
                if (!Schema::hasColumn('students', 'level')) $table->string('level', 30)->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('grades');
        Schema::dropIfExists('enrollments');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('semesters');
        Schema::dropIfExists('academic_years');
    }
};
