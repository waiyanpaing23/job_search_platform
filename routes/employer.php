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

        Route::get('applicants', [EmployerController::class, 'applicantList'])->name('applicant.list');
        Route::get('applicants/{id}', [EmployerController::class, 'applicantDetail'])->name('applicant.detail');
        Route::patch('applicants/{id}/status', [EmployerController::class, 'updateStatus'])->name('applicant.status.update');

        Route::get('job/list', [JobController::class, 'list'])->name('employer.job.list');
        Route::get('job/edit/{id}', [JobController::class, 'edit'])->name('job.edit');
        Route::post('job/edit/{id}', [JobController::class, 'update'])->name('job.update');
        Route::post('job/close/{id}', [JobController::class, 'close'])->name('job.close');
        Route::post('job/activate/{id}', [JobController::class, 'activate'])->name('job.activate');
        Route::get('job/delete/{id}', [JobController::class, 'delete'])->name('job.delete');
    });

    Route::get('employer/applicant/{id}/profile', [EmployerController::class, 'applicantProfile'])->name('applicant.profile.view');

    Route::prefix('company')->group( function() {
        Route::get('create', [CompanyController::class, 'create'])->name('company.create');
        Route::post('store', [CompanyController::class, 'store'])->name('company.store');
        Route::get('search', [CompanyController::class, 'search'])->name('employer.company.search');
        Route::get('link/{id}', [CompanyController::class, 'link'])->name('company.link');
        Route::get('edit', [CompanyController::class, 'edit'])->name('company.edit');
        Route::post('edit', [CompanyController::class, 'update'])->name('company.update');
        Route::get('remove/{id}', [CompanyController::class, 'remove'])->name('company.remove');
    });
});

Route::get('companies', [CompanyController::class, 'list'])->name('companies');
Route::get('company/{id}', [CompanyController::class, 'detail'])->name('company.detail');
