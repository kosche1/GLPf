<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ChallengeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // User Management Routes (Protected by superadmin middleware)
    Route::middleware(['role:superadmin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::get('users/export', [UserController::class, 'export'])->name('users.export');
        Route::resource('roles', RoleController::class);
        Route::resource('levels', LevelController::class);
    });

    // Teacher specific routes
    Route::middleware(['role:teacher'])->group(function () {
        Route::get('/challenges', [ChallengeController::class, 'index'])->name('challenges.index');
        Route::get('/challenges/create', [ChallengeController::class, 'create'])->name('challenges.create');
        Route::post('/challenges', [ChallengeController::class, 'store'])->name('challenges.store');
        Route::get('/challenges/progress', [ChallengeController::class, 'progress'])->name('challenges.progress');
        Route::get('/challenges/{challenge}', [ChallengeController::class, 'show'])->name('challenges.show');
        Route::get('/challenges/{challenge}/edit', [ChallengeController::class, 'edit'])->name('challenges.edit');
        Route::put('/challenges/{challenge}', [ChallengeController::class, 'update'])->name('challenges.update');
        Route::delete('/challenges/{challenge}', [ChallengeController::class, 'destroy'])->name('challenges.destroy');
    });

    // Multiple roles
    Route::middleware(['role:admin|teacher'])->group(function () {
        // Routes for either admin OR teacher
    });

    Route::middleware(['role_or_permission:admin|edit users'])->group(function () {
        // Routes for admin OR users with 'edit users' permission
    });
});

// useless routes
// Just to demo sidebar dropdown links active states.
Route::get('/buttons/text', function () {
    return view('buttons-showcase.text');
})->middleware(['auth'])->name('buttons.text');

Route::get('/buttons/icon', function () {
    return view('buttons-showcase.icon');
})->middleware(['auth'])->name('buttons.icon');

Route::get('/buttons/text-icon', function () {
    return view('buttons-showcase.text-icon');
})->middleware(['auth'])->name('buttons.text-icon');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
