<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobController;
use App\Models\Employer;
use Illuminate\Support\Facades\Route;

Route::prefix('employer')->group( function() {
    Route::get('/', [EmployerController::class, 'index'])->name('employer');
});

Route::middleware('auth')->group(function () {
    Route::prefix('employer')->middleware('employer')->group( function() {
        Route::get('job/new', [JobController::class, 'create'])->name('job.new');
        Route::post('job/new', [JobController::class, 'store'])->name('job.store');
        Route::get('profile', [EmployerController::class, 'profile'])->name('employer.profile');
        Route::get('profile/edit', [EmployerController::class, 'editProfile'])->name('employer.profile.edit');
        Route::post('profile/edit', [EmployerController::class, 'updateProfile'])->name('employer.profile.update');
    });

    Route::prefix('company')->group( function() {
        Route::get('create', [CompanyController::class, 'create'])->name('company.create');
        Route::post('store', [CompanyController::class, 'store'])->name('company.store');
        Route::get('search', [CompanyController::class, 'search'])->name('employer.company.search');
        Route::get('link/{id}', [CompanyController::class, 'link'])->name('company.link');
        Route::get('edit', [CompanyController::class, 'edit'])->name('company.edit');
        Route::post('edit', [CompanyController::class, 'update'])->name('company.update');
        Route::get('{id}', [CompanyController::class, 'detail'])->name('company.detail');
    });
});
