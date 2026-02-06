<?php

use App\Http\Controllers\App\DashboardController;
use App\Http\Controllers\App\HouseholdController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('marketing.landing');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('/login', [LoginController::class, 'index'])->name('login.index');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::delete('/logout', [LoginController::class, 'destroy'])->name('login.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/household', [HouseholdController::class, 'store'])->name('household.store');
    Route::put('/household', [HouseholdController::class, 'update'])->name('household.update');
    Route::post('/household/switch', [HouseholdController::class, 'switch'])->name('household.switch');
});
