<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('users')->group(function () {
        Route::get('/all', [UserController::class, 'allUsers']);
        Route::get('/loggedInUserData', [UserController::class, 'loggedInUserData']);
    });

    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/logins', [AuthController::class, 'logins']);
});
