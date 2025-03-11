<?php

use App\Http\Controllers\API\CollegeAdmin\CollegeAdminAuthController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'collegeadmin'], function () {
    Route::post('login', [CollegeAdminAuthController::class, 'login'])->name('collegeadminlogin');
});

