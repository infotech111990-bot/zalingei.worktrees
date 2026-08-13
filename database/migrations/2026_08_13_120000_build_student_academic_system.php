<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void {
  Schema::table('students', function(Blueprint $table){
   if(!Schema::hasColumn('students','user_id')) $table->unsignedBigInteger('user_id')->nullable()->after('id');
   if(!Schema::hasColumn('students','academic_status')) $table->string('academic_status',30)->default('active')->after('status');
   if(!Schema::hasColumn('students','payment_receipt_path')) $table->string('payment_receipt_path')->nullable()->after('academic_status');
   if(!Schema::hasColumn('students','payment_status')) $table->string('payment_status',20)->default('pending')->after('payment_receipt_path');
   if(!Schema::hasColumn('students','level')) $table->string('level',30)->nullable()->after('academic_year');
  });
  if(!Schema::hasTable('academic_years')) Schema::create('academic_years',function(Blueprint $t){$t->id();$t->string('name',50)->unique();$t->boolean('is_current')->default(false);$t->timestamps();});
  if(!Schema::hasTable('semesters')) Schema::create('semesters',function(Blueprint $t){$t->id();$t->foreignId('academic_year_id')->constrained('academic_years')->cascadeOnDelete();$t->string('name',50);$t->unsignedTinyInteger('term')->default(1);$t->boolean('is_current')->default(false);$t->timestamps();$t->index(['academic_year_id','term']);});
  if(!Schema::hasTable('courses')) Schema::create('courses',function(Blueprint $t){$t->id();$t->unsignedInteger('department_id')->nullable();$t->string('code',50)->unique();$t->string('name_ar')->nullable();$t->string('name_en');$t->unsignedTinyInteger('credit_hours')->default(3);$t->boolean('active')->default(true);$t->timestamps();$t->foreign('department_id')->references('id')->on('dept')->nullOnDelete();});
  if(!Schema::hasTable('enrollments')) Schema::create('enrollments',function(Blueprint $t){$t->id();$t->foreignId('student_id')->constrained('students')->cascadeOnDelete();$t->foreignId('course_id')->constrained('courses')->cascadeOnDelete();$t->foreignId('semester_id')->constrained('semesters')->cascadeOnDelete();$t->string('status',20)->default('enrolled');$t->timestamps();$t->unique(['student_id','course_id','semester_id']);});
  if(!Schema::hasTable('grades')) Schema::create('grades',function(Blueprint $t){$t->id();$t->foreignId('student_id')->constrained('students')->cascadeOnDelete();$t->foreignId('course_id')->constrained('courses')->cascadeOnDelete();$t->foreignId('semester_id')->constrained('semesters')->cascadeOnDelete();$t->decimal('midterm',5,2)->nullable();$t->decimal('final',5,2)->nullable();$t->decimal('practical',5,2)->nullable();$t->decimal('total_score',5,2)->nullable();$t->string('letter_grade',5)->nullable();$t->decimal('grade_points',4,2)->nullable();$t->timestamps();$t->unique(['student_id','course_id','semester_id']);});
 }
 public function down(): void { Schema::dropIfExists('grades');Schema::dropIfExists('enrollments');Schema::dropIfExists('courses');Schema::dropIfExists('semesters');Schema::dropIfExists('academic_years');Schema::table('students',function(Blueprint $t){foreach(['user_id','academic_status','payment_receipt_path','payment_status','level'] as $c) if(Schema::hasColumn('students',$c)) $t->dropColumn($c);}); }
};
