<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;

Route::get('/', [DashboardController::class, 'index']);

Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');