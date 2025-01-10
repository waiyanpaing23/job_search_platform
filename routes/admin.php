<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployerController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('admin')->group( function() {
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin');
    Route::get('users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('users/{id}', [AdminController::class, 'viewProfile'])->name('user.view');
});
