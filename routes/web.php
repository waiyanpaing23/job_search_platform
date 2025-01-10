<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkillController;
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

// Route::get('/', function () {
//     $jobs = Job::all();

//     return view('user.dashboard', compact('jobs'));
// })->name('user.dashboard');

Route::get('/', [ApplicantController::class, 'index'])->name('user.dashboard');

Route::get('job/search', [ApplicantController::class, 'jobList'])->name('list');
Route::get('job/{id}', [JobController::class, 'detail'])->name('job.detail');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('profile/image/update', [ProfileController::class, 'updateImage'])->name('profile.image.update');
    Route::get('profile/image/remove', [ProfileController::class, 'removeImage'])->name('profile.image.remove');

    Route::get('job/{id}/application', [ApplicationController::class, 'application'])->name('application');
    ROute::post('job/{id}/application/submit', [ApplicationController::class, 'submitApplication'])->name('application.submit');

    // Route::get('home', [UserController::class, 'index'])->name('home')->middleware('user');

    Route::prefix('applicant')->middleware('applicant')->group( function() {
        Route::get('profile', [ApplicantController::class, 'profile'])->name('applicant.profile');
        Route::get('profile/edit', [ApplicantController::class, 'editProfile'])->name('applicant.profile.edit');
        Route::post('profile/edit', [ApplicantController::class, 'updateProfile'])->name('applicant.profile.update');

        Route::post('experience/create', [ExperienceController::class, 'create'])->name('experience.create');
        Route::post('experience/update', [ExperienceController::class, 'update'])->name('experience.update');
        Route::get('experience/delete/{id}', [ExperienceController::class, 'delete'])->name('experience.delete');

        Route::post('education/create', [EducationController::class, 'create'])->name('education.create');
        Route::post('education/update', [EducationController::class, 'update'])->name('education.update');
        Route::get('education/delete/{id}', [EducationController::class, 'delete'])->name('education.delete');

        Route::post('/skills/add', [SkillController::class, 'create'])->name('skill.create');
        Route::delete('/skills/delete/{id}', [SkillController::class, 'delete'])->name('skill.delete');

        Route::get('applications', [ApplicationController::class, 'list'])->name('application.list');
        Route::get('applications/{id}', [ApplicationController::class, 'detail'])->name('application.detail');
        Route::get('application/{id}/withdraw', [ApplicationController::class, 'withdraw'])->name('application.withdraw');

    });

});

require __DIR__.'/auth.php';
require __DIR__.'/employer.php';
require __DIR__.'/admin.php';

Route::get('/auth/{provider}/redirect', [SocialiteController::class, 'redirect']);

Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback']);

