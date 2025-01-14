<?php

use App\Http\Controllers\User\UserLoginController;
use App\Http\Controllers\User\UserRegisterController;
use Illuminate\Support\Facades\Route;

Route::name('user.')->group(function () {
    Route::get('userregister', [UserRegisterController::class, 'userregisterindex'])->name('userregister');
    Route::post('userregister', [UserRegisterController::class, 'userregisterstore'])->name('userregister.store');
    Route::get('userlogin', [UserLoginController::class, 'userloginindex'])->name('userlogin');
    Route::post('userlogin', [UserLoginController::class, 'userlogincheck'])->name('userlogin.check');
});
