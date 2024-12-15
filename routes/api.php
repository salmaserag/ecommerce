<?php

use App\Http\Controllers\Api\Admin\RoleController;
use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\User\AccesTokensController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\UserController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');




Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/me', [AuthController::class, 'me']);
});

Route::middleware(['Jwt'])->name('api.')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::apiResource('roles', RoleController::class);

    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::post('/users', [UserController::class, 'store']);
    Route::post('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

});


//this route to login --> guest
Route::post('auth/access-tokens', [AccesTokensController::class, 'store'])
    ->middleware('guest:sanctum');


//to use these route you shoud be authenticated
Route::middleware([ 'CheckApiToken' , 'auth:sanctum' ,])->group(function () {

    //information about which user logened 
    Route::get('/user', function (Request $request) {
        return Auth::guard('sanctum')->user();
    });

    //to delete token of current user --> optinal token
    Route::delete('auth/access-tokens/{token?}', [AccesTokensController::class, 'destroy']);


});

