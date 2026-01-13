<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\TaskCategoryController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::prefix('task_categories')->name('task_categories.')->group(function () {

        Route::get('/', [TaskCategoryController::class, 'index'])->name('index');
        Route::get('/create', [TaskCategoryController::class, 'create'])->name('create');
        Route::post('/', [TaskCategoryController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [TaskCategoryController::class, 'edit'])->name('edit');
        Route::put('/{id}', [TaskCategoryController::class, 'update'])->name('update');
        Route::delete('/{id}', [TaskCategoryController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('tasks')->name('tasks.')->group(function () {
        Route::get('/', [TaskController::class, 'index'])->name('index');
        Route::get('/create', [TaskController::class, 'create'])->name('create');
        Route::post('/', [TaskController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [TaskController::class, 'edit'])->name('edit');
        Route::put('/{id}', [TaskController::class, 'update'])->name('update');
        Route::delete('/{id}', [TaskController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('classrooms')->name('classrooms.')->group(function () {
        Route::get('/', [ClassroomController::class, 'index'])->name('index');
        Route::get('/create', [ClassroomController::class, 'create'])->name('create');
        Route::post('/', [ClassroomController::class, 'store'])->name('store');
        Route::get('/{classroom}/edit', [ClassroomController::class, 'edit'])->name('edit');
        Route::put('/{classroom}', [ClassroomController::class, 'update'])->name('update');
        Route::delete('/{classroom}', [ClassroomController::class, 'destroy'])->name('destroy');
        Route::get('/{classroom}', [ClassroomController::class, 'show'])->name('show');
    });

});



require __DIR__ . '/settings.php';
