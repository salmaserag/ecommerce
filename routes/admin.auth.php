<?php

use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Auth\AdminRegisteredController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('guest:admin')->group(function () {

    
    // Route::get('register', [AdminRegisteredController::class, 'create'])
    //     ->name('admin.register');

    // Route::post('register', [AdminRegisteredController::class, 'store']);

    Route::get('login', [AdminLoginController::class, 'create'])
        ->name('admin.login');

    Route::post('login', [AdminLoginController::class, 'store']);

   
});

Route::prefix('admin')->middleware('auth:admin')->group(function () {

    
    

    Route::post('logout', [AdminLoginController::class, 'destroy'])
        ->name('admin.logout');
});
