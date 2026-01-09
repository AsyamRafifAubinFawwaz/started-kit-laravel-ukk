<?php

use App\Http\Controllers\TaskCategoryController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('task_categories')->group(function () {
        Route::get('/', [TaskCategoryController::class, 'index'])->name('task_categories.index');
        Route::get('/create', [TaskCategoryController::class, 'create'])->name('task_categories.create');
        Route::post('/', [TaskCategoryController::class, 'store'])->name('task_categories.store');
        Route::get('/{id}/edit', [TaskCategoryController::class, 'edit'])->name('task_categories.edit');
        Route::put('/{id}', [TaskCategoryController::class, 'update'])->name('task_categories.update');
        Route::delete('/{id}', [TaskCategoryController::class, 'destroy'])->name('task_categories.destroy');
    });

    Route::prefix('tasks')->group(function () {
        Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
        Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
        Route::post('/', [TaskController::class, 'store'])->name('tasks.store');
        Route::get('/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
        Route::put('/{id}', [TaskController::class, 'update'])->name('tasks.update');
        Route::delete('/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    });
});
require __DIR__.'/settings.php';
