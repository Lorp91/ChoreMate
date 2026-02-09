<?php

use App\Http\Controllers\App\DashboardController;
use App\Http\Controllers\App\HouseholdController;
use App\Http\Controllers\App\RoomController;
use App\Http\Controllers\App\TaskController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('marketing.landing'));

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('/login', [LoginController::class, 'index'])->name('login.index');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::delete('/logout', [LoginController::class, 'destroy'])->name('login.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('households')->name('households.')->group(function () {
        Route::get('/', [HouseholdController::class, 'index'])->name('index');
        Route::get('/create', [HouseholdController::class, 'create'])->name('create');
        Route::post('/', [HouseholdController::class, 'store'])->name('store');
        Route::get('/{household}', [HouseholdController::class, 'show'])->name('show');
        Route::get('/{household}/edit', [HouseholdController::class, 'edit'])->name('edit');
        Route::put('/{household}', [HouseholdController::class, 'update'])->name('update');
        Route::delete('/{household}', [HouseholdController::class, 'destroy'])->name('destroy');

        Route::prefix('/{household}/rooms')->name('rooms.')->group(function () {
            Route::get('/', [RoomController::class, 'index'])->name('index');
            Route::get('/create', [RoomController::class, 'create'])->name('create');
            Route::post('/', [RoomController::class, 'store'])->name('store');
            Route::get('/{room}', [RoomController::class, 'show'])->name('show');
            Route::get('/{room}/edit', [RoomController::class, 'edit'])->name('edit');
            Route::put('/{room}', [RoomController::class, 'update'])->name('update');
            Route::delete('/{room}', [RoomController::class, 'destroy'])->name('destroy');

            Route::prefix('/{room}/tasks')->name('tasks.')->group(function () {
                Route::get('/', [TaskController::class, 'index'])->name('index');
                Route::get('/create', [TaskController::class, 'create'])->name('create');
                Route::post('/', [TaskController::class, 'store'])->name('store');
                Route::get('/{task}', [TaskController::class, 'show'])->name('show');
                Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('edit');
                Route::put('/{task}', [TaskController::class, 'update'])->name('update');
                Route::delete('/{task}', [TaskController::class, 'destroy'])->name('destroy');

                Route::patch('/{task}', [TaskController::class, 'complete'])->name('complete');
            });
        });
    });
});
