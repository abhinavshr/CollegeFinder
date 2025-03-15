<?php

use App\Http\Controllers\API\CollegeAdmin\CollegeAdminAPIController;
use App\Http\Controllers\API\CollegeAdmin\CollegeAdminUpdateApiController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'collegeadmin'], function () {
    Route::post('login', [CollegeAdminAPIController::class, 'login']);
    Route::post('add-colleges', [CollegeAdminAPIController::class, 'store'])->middleware('auth:collegeadmin');
    Route::get('colleges-lists', [CollegeAdminAPIController::class, 'collegeslists'])->middleware('auth:collegeadmin');
    Route::post('add-courses', [CollegeAdminAPIController::class, 'courseStore'])->middleware('auth:collegeadmin');
    Route::get('courses-lists', [CollegeAdminAPIController::class, 'courseList'])->middleware('auth:collegeadmin');
    Route::post('add-scholarships', [CollegeAdminAPIController::class, 'scholarshipStore'])->middleware('auth:collegeadmin');
    Route::get('scholarship-lists', [CollegeAdminAPIController::class, 'scholarshipList'])->middleware('auth:collegeadmin');
    Route::post('add-college-gallery', [CollegeAdminAPIController::class, 'collegeGalleryStore'])->middleware('auth:collegeadmin');
    Route::get('college-gallery-lists', [CollegeAdminAPIController::class, 'collegeGalleryList'])->middleware('auth:collegeadmin');
    Route::put('update-college-admin', [CollegeAdminUpdateApiController::class, 'update'])->middleware('auth:collegeadmin');
    Route::put('colleges/{id}', [CollegeAdminUpdateApiController::class, 'Collegeupdate'])->middleware('auth:collegeadmin');
    Route::delete('college-gallery/{id}', [CollegeAdminUpdateApiController::class, 'CollegegalleryDelete'])->middleware('auth:collegeadmin');
    Route::delete('scholarship/{id}', [CollegeAdminUpdateApiController::class, 'ScholarshipDelete'])->middleware('auth:collegeadmin');
    Route::delete('course/{id}', [CollegeAdminUpdateApiController::class, 'CourseDelete'])->middleware('auth:collegeadmin');
    Route::delete('college/{id}', [CollegeAdminUpdateApiController::class, 'CollegeDelete'])->middleware('auth:collegeadmin');
    Route::get('logout', [CollegeAdminUpdateApiController::class, 'logout'])->middleware('auth:collegeadmin');
});
