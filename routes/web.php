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
    return view('home');
})->name('home');

Route::get('/houses', function () {
    return view('houses');
})->name('houses');

Route::get('/land', function () {
    return view('land');
})->name('land');

Route::get('/commercial', function () {
    return view('commercial');
})->name('commercial');

Route::get('/property/details', function () {
    return view('property_details');
})->name('property_details');

Route::get('/login', function () {
    return view('auth.pages-login');
})->name('auth.login');

Route::get('/register', function () {
    return view('auth.pages-register');
})->name('auth.register');

Route::get('/notFound', function () {
    return view('errorPages.page404');
})->name('error.notFound');

// Client
Route::prefix('client')->group(function () {

    Route::get('/dashboard', function () {
        return view('client.dashboard');
    })->name('client.dashboard');

    Route::get('/profile', function () {
        return view('client.profile');
    })->name('client.profile');

    Route::get('/appointment', function () {
        return view('client.appointment');
    })->name('client.appointment');
});

// Agent
Route::prefix('agent')->group(function () {
    Route::get('/dashboard', function () {
        return view('agent.dashboard');
    })->name('agent.dashboard');

    Route::get('/properties/all', function () {
        return view('agent.allProperty');
    })->name('agent.allProperty');

    Route::get('/properties/forRent', function () {
        return view('agent.forRent');
    })->name('agent.forRent');

    Route::get('/properties/forSale', function () {
        return view('agent.forSale');
    })->name('agent.forSale');

    Route::get('/properties/add', function () {
        return view('agent.addNew');
    })->name('agent.addNew');

    Route::get('/appointment', function () {
        return view('agent.appointment');
    })->name('agent.appointment');

    Route::get('/profile', function () {
        return view('agent.profile');
    })->name('agent.profile');
});

// Admin
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/profile', function () {
        return view('admin.profile');
    })->name('admin.profile');

    Route::get('/clients', function () {
        return view('admin.clients');
    })->name('admin.clients');

    Route::get('/agents', function () {
        return view('admin.agents');
    })->name('admin.agents');
});
