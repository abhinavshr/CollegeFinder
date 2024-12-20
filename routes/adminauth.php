<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Pages\AdminlistController;
use App\Http\Controllers\CollegeAdmin\CollegeAdminController;
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
});
