<?php

use App\Http\Controllers\User\AboutUsController;
use App\Http\Controllers\User\ComparisonController;
use App\Http\Controllers\User\ContactUsController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\UserLoginController;
use App\Http\Controllers\User\UserRegisterController;
use Illuminate\Support\Facades\Route;

Route::name('user.')->group(function () {
    Route::get('userregister', [UserRegisterController::class, 'userregisterindex'])->name('userregister');
    Route::post('userregister', [UserRegisterController::class, 'userregisterstore'])->name('userregister.store');
    Route::get('userlogin', [UserLoginController::class, 'userloginindex'])->name('userlogin');
    Route::post('userlogin', [UserLoginController::class, 'userlogincheck'])->name('userlogin.check');
    Route::get('/', [HomeController::class, 'homeindex'])->name('home');
    Route::get('contactus', [ContactUsController::class, 'ContactUsIndex'])->name('contactus');
    Route::get('aboutus', [AboutUsController::class, 'AboutUsIndex'])->name('aboutus');
});

Route::name('user.')->middleware(['auth:web'])->group(function () {
    Route::post('contactus', [ContactUsController::class, 'ContactUsStore'])->name('contactus.store');
    Route::post('userlogout', [UserLoginController::class, 'userlogout'])->name('userlogout');
    Route::get('comparecollege', [ComparisonController::class, 'ComparisonIndex'])->name('compare');
    Route::get('/colleges/{id}', [ComparisonController::class, 'getCollegeData']);

});
