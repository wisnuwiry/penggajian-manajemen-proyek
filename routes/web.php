<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Employee
    Route::resource('employee', EmployeeController::class)->except(['show']);

    // Department
    Route::resource('department', DepartmentController::class)->except(['show']);

    // Position
    Route::resource('position', PositionController::class)->except(['show']);

    // Payroll
    Route::resource('payroll', PayrollController::class);
    Route::get('/payroll/payslips/download/{id}', [PayrollController::class, 'download'])->name('payslip.download');
    Route::get('/payroll/payslips/token/{id}', [PayrollController::class, 'getPayslipToken'])->name('payslips.token');
    Route::get('/payroll/payslips/view/{token}', [PayrollController::class, 'showPayslipWithToken'])->name('payslips.viewWithToken');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Api
    Route::get('/api/departments', [DepartmentController::class, 'ajax'])->name('api.departments');
    Route::get('/api/positions', [PositionController::class, 'ajax'])->name('api.positions');
});

require __DIR__.'/auth.php';
