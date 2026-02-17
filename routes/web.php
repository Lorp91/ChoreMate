<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HouseholdController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('pages.marketing.landing'));

Route::middleware('auth')->group(function () {
    Route::prefix('households')->name('households.')->group(function () {
        Route::get('/', [HouseholdController::class, 'index'])->name('index');
        Route::get('/create', [HouseholdController::class, 'create'])->name('create');
        Route::post('/', [HouseholdController::class, 'store'])->name('store');
        Route::get('/{household}', [HouseholdController::class, 'show'])->name('show');
        Route::get('/{household}/edit', [HouseholdController::class, 'edit'])->name('edit');
        Route::put('/{household}', [HouseholdController::class, 'update'])->name('update');
        Route::delete('/{household}', [HouseholdController::class, 'destroy'])->name('destroy');

        Route::get('/{household}/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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
