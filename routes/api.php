<?php

use App\Http\Controllers\AgentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\AppointmentController;

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

    Route::prefix('properties')->group(function () {
        Route::get('/all/{filter}', [AgentController::class, 'all']);
        Route::get('/forSale/{filter}', [AgentController::class, 'forSale']);
        Route::get('/forRent/{filter}', [AgentController::class, 'forRent']);
        Route::get('/all/search/{data}', [AgentController::class, 'search']);
        Route::get('/forRent/search/{data}', [AgentController::class, 'searchForRent']);
        Route::get('/forSale/search/{data}', [AgentController::class, 'searchForSale']);
        Route::post('/update/{id}', [PropertyController::class, 'update']);
        Route::delete('/delete/{id}', [PropertyController::class, 'destroy']);
        Route::post('/store', [PropertyController::class, 'store']);
    });

    Route::prefix('appointment')->group(function () {
        Route::post('/store', [AppointmentController::class, 'store']);
        Route::get('/client', [AppointmentController::class, 'clientAppointments']);
        Route::get('/agent', [AppointmentController::class, 'agentAppointments']);
        Route::delete('/delete/{id}', [AppointmentController::class, 'delete']);
        Route::post('/schedule/{id}', [AppointmentController::class, 'scheduleAppointment']);
    });

    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/logins', [AuthController::class, 'logins']);
});

Route::post('/register', [AuthController::class, 'register']);

Route::get('properties', [PropertyController::class, 'getAll']);
Route::get('properties/{id}', [PropertyController::class, 'show']);
Route::get('properties/search/{data}', [PropertyController::class, 'search']);
Route::get('properties/search/house/{data}', [PropertyController::class, 'searchHouse']);
Route::get('properties/search/land/{data}', [PropertyController::class, 'searchLand']);
Route::get('properties/search/commercial/{data}', [PropertyController::class, 'searchCommercial']);
Route::get('house', [PropertyController::class, 'house']);
Route::get('land', [PropertyController::class, 'land']);
Route::get('commercial', [PropertyController::class, 'commercial']);
Route::get('forSale', [PropertyController::class, 'forSale']);
Route::get('forRent', [PropertyController::class, 'forRent']);
