<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InstituteController;
use App\Http\Controllers\SettingsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->group(function() {
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:api')->group(function () {
        Route::get('/logout', [AuthController::class, 'logout']);
        Route::get('/profile', [AuthController::class, 'profile']);
    });
});


Route::prefix('user')->middleware('auth:api')->group(function() {
    Route::prefix('setting')->group(function() {
        Route::get('/roles', [SettingsController::class, 'getRoles']);
        Route::resource('institutes', InstituteController::class);
    });
});
