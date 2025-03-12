<?php

use App\Http\Controllers\API\CollegeAdmin\CollegeAdminAuthController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'collegeadmin'], function () {
    Route::post('register', [CollegeAdminAuthController::class, 'register'])->name('collegeadminregister');
    Route::post('login', [CollegeAdminAuthController::class, 'login'])->name('collegeadminlogin');
});

Route::group(['prefix' => 'collegeadmin', 'middleware' => 'auth:collegeadmin'], function () {
    Route::put('/update-profile', [CollegeAdminAuthController::class, 'updateProfile'])->name('collegeadminupdateprofile');
});

