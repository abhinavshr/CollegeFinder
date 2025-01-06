<?php

use App\Http\Controllers\Admin\Pages\AdminlistController;
use App\Http\Controllers\CollegeAdmin\CollegeAdminController;
use App\Http\Controllers\CollegeAdmin\CollegeController;
use App\Http\Controllers\collegeAdmin\CollegeGalleryController;
use App\Http\Controllers\CollegeAdmin\CourseController;
use App\Http\Controllers\collegeAdmin\DashboardController;
use App\Http\Controllers\CollegeAdmin\ProfileController;
use App\Http\Controllers\ScholarshipController;
use Illuminate\Support\Facades\Route;

Route::prefix('collegeadmin')->name('collegeadmin.')->group(function () {
    Route::get('collegeadminlogin', [CollegeAdminController::class, 'admincollegelogin'])->name('collegeadminlogin');
    Route::post('/collegeadmin/login/check', [CollegeAdminController::class, 'admincollegelogincheck'])->name('collegeadminlogin.check');

});

Route::prefix('collegeadmin')->name('collegeadmin.')->middleware('auth:collegeadmin')->group(function () {
    Route::get('adminlist', [AdminlistController::class, 'adminlistindex'])->name('adminlist');
    Route::get('profile', [ProfileController::class, 'profileindex'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'profileupdate'])->name('profile.update');
    Route::post('collegeadminlogout', [CollegeAdminController::class, 'collegeadminlogout'])->name('collegeadminlogout');
    Route::put('/collegeadmin/profile/personal-update', [ProfileController::class, 'profilePersonalUpdate'])->name('profile.personalupdate');
    Route::put('/collegeadmin/profile/password-update', [ProfileController::class, 'profilePasswordUpdate'])->name('profile.passwordupdate');
    Route::delete('/collegeadmin/profile/delete', [ProfileController::class, 'profileDelete'])->name('profile.delete');
    Route::get('collegelist', [CollegeController::class, 'collegeviewindex'])->name('collegelist');
    Route::get('collegeadd', [CollegeController::class, 'addcollegeindex'])->name('collegeadd');
    Route::post('collegeadd', [CollegeController::class, 'addcollegestore'])->name('collegeadd.store');
    Route::delete('collegedelete', [CollegeController::class, 'collegedelete'])->name('collegedelete');
    Route::get('collegedetail/{id}', [CollegeController::class, 'collegedetails'])->name('collegedetail');
    Route::put('collegedetail/{id}', [CollegeController::class, 'collegedetailsupdate'])->name('collegedetail.update');
    Route::get('courselist', [CourseController::class, 'courseviewindex'])->name('courselist');
    Route::get('courseadd', [CourseController::class, 'addcourseindex'])->name('courseadd');
    Route::post('courseadd', [CourseController::class, 'coursestore'])->name('courseadd.store');
    Route::delete('/course/{id}', [CourseController::class, 'coursedelete'])->name('coursedelete');
    Route::get('coursedetail/{id}', [CourseController::class, 'coursedetails'])->name('coursedetail');
    Route::put('/collegeadmin/course/{id}', [CourseController::class, 'update'])->name('course.update');
    Route::get('scholarshiplist', [ScholarshipController::class, 'scholarshipviewindex'])->name('scholarshiplist');
    Route::get('scholarshipadd', [ScholarshipController::class, 'addscholarshipindex'])->name('scholarshipadd');
    Route::post('scholarshipadd', [ScholarshipController::class, 'addscholarshipstore'])->name('scholarshipadd.store');
    Route::delete('/scholarships/{id}', [ScholarshipController::class, 'destroy'])->name('scholarships.destroy');
    Route::get('scholarshipdetail/{id}', [ScholarshipController::class, 'scholarshipdetails'])->name('scholarshipdetail');
    Route::put('/scholarships/{id}', [ScholarshipController::class, 'update'])->name('scholarshipupdate.update');
    Route::get('dashboard', [DashboardController::class, 'dashboardindex'])->name('dashboard');
    Route::get('collegegallery', [CollegeGalleryController::class, 'collegegalleryindex'])->name('collegegallery');
    Route::post('collegegallery', [CollegeGalleryController::class, 'collegegallerystore'])->name('college_gallery.store');
    Route::get('addcollegegallery', [CollegeGalleryController::class, 'addcolegegalleryindex'])->name('addcollegegallery');
    Route::delete('collegegallery/{id}', [CollegeGalleryController::class, 'collegegallerydelete'])->name('collegegallery.delete');
});
