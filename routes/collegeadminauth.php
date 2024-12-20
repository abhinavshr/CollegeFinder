<?php

use App\Http\Controllers\Admin\Pages\AdminlistController;
use App\Http\Controllers\CollegeAdmin\CollegeAdminController;
use App\Http\Controllers\CollegeAdmin\ProfileController;
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
});
