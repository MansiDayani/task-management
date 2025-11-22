<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    Route::resource('projects', App\Http\Controllers\ProjectController::class);
    Route::resource('tasks', App\Http\Controllers\TaskController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('points', App\Http\Controllers\PointsController::class);
});

/*
|--------------------------------------------------------------------------
| Developer Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:developer'])->group(function () {

    Route::get('/developer/dashboard', [App\Http\Controllers\DeveloperController::class, 'dashboard'])
        ->name('developer.dashboard');

    Route::get('/developer/tasks', [App\Http\Controllers\DeveloperTaskController::class, 'index'])
        ->name('developer.tasks');

    Route::post('/developer/task/{task}/submit', [App\Http\Controllers\TaskAttemptController::class, 'store'])
        ->name('developer.task.submit')
        ->where('task', '[0-9]+');
});

/*
|--------------------------------------------------------------------------
| Tester Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:tester'])->group(function () {

    Route::get('/tester/dashboard', [App\Http\Controllers\TesterController::class, 'dashboard'])
        ->name('tester.dashboard');

    Route::get('/tester/tasks', [App\Http\Controllers\TesterTaskController::class, 'index'])
        ->name('tester.tasks');

    Route::post('/tester/attempt/{attempt}/review', [App\Http\Controllers\TesterReviewController::class, 'store'])
        ->name('tester.attempt.review')
        ->where('attempt', '[0-9]+');
});


/*
|--------------------------------------------------------------------------
| PM Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:pm'])->group(function () {

    Route::get('/pm/dashboard', [App\Http\Controllers\PMController::class, 'dashboard'])
        ->name('pm.dashboard');

    Route::get('/pm/tasks', [App\Http\Controllers\PMTaskController::class, 'index'])
        ->name('pm.tasks');

    Route::post('/pm/task/{task}/review', [App\Http\Controllers\PMReviewController::class, 'store'])
        ->name('pm.task.review')
        ->where('task', '[0-9]+');

    // PM can manage projects and tasks
    Route::resource('projects', App\Http\Controllers\ProjectController::class);
    Route::resource('tasks', App\Http\Controllers\TaskController::class);
});


/*
|--------------------------------------------------------------------------
| Auth Routes (Breeze / Fortify / UI)
|--------------------------------------------------------------------------
*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
