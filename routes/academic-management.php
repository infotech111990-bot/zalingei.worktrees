<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcademicManagementController;

Route::prefix('academic-management')->name('academic-management.')->group(function () {
    Route::get('/', [AcademicManagementController::class, 'index'])->name('index');
    Route::post('/academic-year', [AcademicManagementController::class, 'storeAcademicYear'])->name('academic-year.store');
    Route::post('/semester', [AcademicManagementController::class, 'storeSemester'])->name('semester.store');
    Route::post('/course', [AcademicManagementController::class, 'storeCourse'])->name('course.store');
    Route::post('/enrollment', [AcademicManagementController::class, 'storeEnrollment'])->name('enrollment.store');
    Route::post('/grade', [AcademicManagementController::class, 'storeGrade'])->name('grade.store');
});
