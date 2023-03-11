<?php

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Guest\HomeController as GuestHomeController;
use App\Http\Controllers\ProfileController;
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
// GUEST HOME
Route::get('/', [GuestHomeController::class, 'index']);

// ADMIN ROUTES GROUP 
Route::middleware(['auth', 'verified'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [AdminHomeController::class, 'index'])->name('home');

    // PROJECTS ROUTES
    Route::resource('projects', ProjectController::class);

    // TYPES ROUTES
    Route::resource('types', TypeController::class);

    // CHECKBOX ROUTE with custom function on controller
    Route::patch('/projects/{project}/toggle', [ProjectController::class, 'togglePublishProject'])->name('projects.toggle');
});



Route::middleware('auth')->name('profile.')->prefix('/profile')->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
});

require __DIR__ . '/auth.php';
