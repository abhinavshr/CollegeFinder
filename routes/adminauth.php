<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Pages\AdminlistController;
use App\Http\Controllers\CollegeAdmin\CollegeAdminController;
use App\Http\Controllers\CollegeAdmin\CollegeController;
use App\Http\Controllers\CollegeAdmin\CourseController;
use App\Http\Controllers\ScholarshipController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('adminregister', [AdminController::class, 'index'])->name('adminregister');
    Route::post('adminregister', [AdminController::class, 'register'])->name('adminregister');
    Route::get('adminlogin', [AdminController::class, 'login'])->name('adminlogin');
    Route::post('adminlogin', [AdminController::class, 'logincheck'])->name('adminlogin.check');
});

Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('adminlist', [AdminlistController::class, 'adminlistindex'])->name('adminlist');
    Route::get('collegeadminregister',[CollegeAdminController::class, 'collegeadminregisterindex'])->name('collegeadminregister');
    Route::post('collegeadminregister', [CollegeAdminController::class, 'collegeadminregister'])->name('collegeadminregister');
    Route::post('adminlogout', [AdminController::class, 'adminlogout'])->name('adminlogout');
    Route::get('collegelist', [CollegeController::class, 'collegeviewindex'])->name('collegelist');
    Route::get('courselist', [CourseController::class, 'courseviewindex'])->name('courselist');
    Route::get('scholarshiplist', [ScholarshipController::class, 'scholarshipviewindex'])->name('scholarshiplist');
});
