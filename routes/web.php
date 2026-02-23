<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HouseholdController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('pages.marketing.landing'));

Route::middleware('auth')
    ->scopeBindings()
    ->group(function () {
        Route::resource('households', HouseholdController::class)->shallow();
        Route::resource('households.rooms', RoomController::class)->shallow();
        Route::resource('households.rooms.tasks', TaskController::class)->shallow();

        Route::get('households/{household}/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::patch('tasks/{task}', [TaskController::class, 'complete'])->name('tasks.complete');
    });
