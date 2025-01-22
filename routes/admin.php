<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('admin')->group( function() {
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin');
    Route::get('users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('users/{id}', [AdminController::class, 'viewProfile'])->name('user.view');
    Route::get('users/delete/{id}', [AdminController::class, 'deleteUser'])->name('user.delete');
    Route::get('jobs', [AdminController::class, 'jobs'])->name('admin.jobs');
    Route::get('jobs/delete/{id}', [JobController::class, 'delete'])->name('job.delete');
    Route::get('companies', [AdminController::class, 'companies'])->name('admin.companies');
    Route::get('applications', [AdminController::class, 'applications'])->name('admin.applications');
    Route::get('applications/delete/{id}',[AdminController::class, 'applicationDelete'])->name('application.delete');
    Route::patch('companies//{id}/status', [AdminController::class, 'updateStatus'])->name('company.status.update');
});
