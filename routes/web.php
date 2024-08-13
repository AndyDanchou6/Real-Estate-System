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
    return view('welcome');
})->name('welcome');

Route::get('/login', function () {
    return view('auth.pages-login');
})->name('auth.login');

Route::get('/register', function () {
    return view('auth.pages-register');
})->name('auth.register');

Route::get('/notFound', function () {
    return view('errorPages.page404');
})->name('error.notFound');

Route::prefix('client')->group(function () {
    Route::get('/dashboard', function () {
        return view('client.dashboard');
    })->name('client.dashboard');
    Route::get('/profile', function () {
        return view('client.profile');
    })->name('client.profile');
});

Route::prefix('agent')->group(function () {
    Route::get('/dashboard', function () {
        return view('agent.dashboard');
    })->name('agent.dashboard');
});

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});
