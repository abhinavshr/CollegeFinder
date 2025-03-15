<?php

use App\Http\Controllers\API\Admin\AdminApiController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function () {
    Route::post('register', [AdminApiController::class, 'register'])->name('adminregister');
    Route::post('login', [AdminApiController::class, 'login'])->name('adminlogin');
    Route::post('/college-admins', [AdminApiController::class, 'store'])->middleware('auth:admin');
    Route::get('college-admins-lists', [AdminApiController::class, 'collegeadminlist'])->middleware('auth:admin');
    Route::get('colleges-lists', [AdminApiController::class, 'collegelist'])->middleware('auth:admin');
    Route::get('scholarships-lists', [AdminApiController::class, 'scholarshiplist'])->middleware('auth:admin');
    Route::get('courses-lists', [AdminApiController::class, 'courselist'])->middleware('auth:admin');
    Route::get('users-lists', [AdminApiController::class, 'userlist'])->middleware('auth:admin');
    Route::get('logout', [AdminApiController::class, 'logout'])->middleware('auth:admin');
});

