<?php

use App\Models\Role;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartCotroller;
use App\Http\Controllers\SongController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Mail\ContactController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('website.home');
})->name('website');


Route::get('/web-categories', [CategoryController::class, 'allCategory'])->name('web-categories');


Route::get('/web-product/{category}', [CategoryController::class, 'categoryProducts'])->name('web-product');


Route::get('/web-register', [RegisteredUserController::class, 'create'])->name('web-register');



Route::post('/web-store', [RegisteredUserController::class, 'store'])->name('web-store');


Route::get('/web-login', [AuthenticatedSessionController::class, 'create'])->name('web-login');


Route::post('/web-login-store', [AuthenticatedSessionController::class, 'store'])->name('web-login-store');


Route::post('/web-logout', [AuthenticatedSessionController::class, 'destroy'])
->name('user.logout');


Route::resource('carts', CartCotroller::class);





Route::prefix('admin')->middleware(['auth:admin', 'verified','CheckRole'])->group(function(){
    Route::get('/', function () {
        return view('dashboard.home');
    })->name('admin.home');
    
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::post('/validate-email', [UserController::class, 'validateEmail']);

});


Route::get('songs', [SongController::class , 'index'])->name('songs.index');
Route::post('songs/import', [SongController::class , 'import'])->name('songs.import');
Route::post('songs/import2', [SongController::class , 'import2'])->name('songs.import2');
Route::post('songs/store', [SongController::class , 'store'])->name('songs.store');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/contact-us' , [ContactController::class ,'index']);

require __DIR__.'/auth.php';
require __DIR__.'/admin.auth.php';

