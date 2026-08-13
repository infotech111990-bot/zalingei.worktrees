<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('academic_years')) {
            Schema::table('academic_years', function (Blueprint $table) {
                if (!Schema::hasColumn('academic_years', 'name_ar')) $table->string('name_ar', 100)->nullable();
                if (!Schema::hasColumn('academic_years', 'start_date')) $table->date('start_date')->nullable();
                if (!Schema::hasColumn('academic_years', 'end_date')) $table->date('end_date')->nullable();
                if (!Schema::hasColumn('academic_years', 'status')) $table->boolean('status')->default(true);
            });
        }

        if (Schema::hasTable('semesters')) {
            Schema::table('semesters', function (Blueprint $table) {
                if (!Schema::hasColumn('semesters', 'name_ar')) $table->string('name_ar', 100)->nullable();
                if (!Schema::hasColumn('semesters', 'semester_number')) $table->unsignedTinyInteger('semester_number')->nullable();
                if (!Schema::hasColumn('semesters', 'start_date')) $table->date('start_date')->nullable();
                if (!Schema::hasColumn('semesters', 'end_date')) $table->date('end_date')->nullable();
                if (!Schema::hasColumn('semesters', 'status')) $table->boolean('status')->default(true);
            });
            if (Schema::hasColumn('semesters', 'term') && Schema::hasColumn('semesters', 'semester_number')) {
                DB::statement('UPDATE semesters SET semester_number = term WHERE semester_number IS NULL');
            }
        }

        if (Schema::hasTable('courses')) {
            Schema::table('courses', function (Blueprint $table) {
                if (!Schema::hasColumn('courses', 'name')) $table->string('name', 255)->nullable();
                if (!Schema::hasColumn('courses', 'status')) $table->boolean('status')->default(true);
            });
            if (Schema::hasColumn('courses', 'name_en') && Schema::hasColumn('courses', 'name')) {
                DB::statement("UPDATE courses SET name = name_en WHERE name IS NULL OR name = ''");
            }
        }

        if (Schema::hasTable('grades') && !Schema::hasColumn('grades', 'remarks')) {
            Schema::table('grades', function (Blueprint $table) {
                $table->text('remarks')->nullable();
            });
        }
    }

    public function down(): void
    {
        // Compatibility fields are intentionally retained on rollback to avoid data loss.
    }
};
