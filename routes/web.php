<?php

use App\Http\Controllers\Dashboard\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Middleware\CheckRole;
use App\Models\Role;

Route::get('/', function () {
    return' website theme';
});



Route::prefix('admin')->middleware(['auth', 'verified','CheckRole'])->group(function(){
    Route::get('/', function () {
        return view('dashboard.home');
    })->name('admin');
    
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
