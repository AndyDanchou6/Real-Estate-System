<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.pages-login');
});

Route::get('/register', function () {
    return view('auth.pages-register');
});

Route::get('/notFound', function () {
    return view('errorPages.page404');
});

Route::prefix('agent')->group(function () {
    Route::get('/dashboard', function () {
        return view('agent.dashboard');
    });
});

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
});
