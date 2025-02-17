<?php

use App\Http\Controllers\API\Admin\AdminApiController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function () {
    Route::post('register', [AdminApiController::class, 'register'])->name('adminregister');
    Route::post('login', [AdminApiController::class, 'login'])->name('adminlogin');
});

