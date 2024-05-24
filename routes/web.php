<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Employee
    Route::resource('employee', EmployeeController::class)->except(['show']);

    // Department
    Route::resource('department', DepartmentController::class);

    // Posotion
    Route::resource('position', PositionController::class);

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Api
    Route::get('/api/departments', [DepartmentController::class, 'ajax'])->name('api.departments');
    Route::get('/api/positions', [PositionController::class, 'ajax'])->name('api.positions');
});

require __DIR__.'/auth.php';
