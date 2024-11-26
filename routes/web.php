<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\UserController;
use App\Models\Job;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $jobs = Job::all();

    return view('user.dashboard', compact('jobs'));
})->name('user.dashboard');

Route::get('/search-job', [ApplicantController::class, 'list'])->name('list');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::get('home', [UserController::class, 'index'])->name('home')->middleware('user');

    Route::prefix('admin')->group( function() {
        Route::get('dashboard', [AdminController::class, 'index'])->name('admin')->middleware('admin');
    });

});

require __DIR__.'/auth.php';
require __DIR__.'/employer.php';

Route::get('/auth/{provider}/redirect', [SocialiteController::class, 'redirect']);

Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback']);

