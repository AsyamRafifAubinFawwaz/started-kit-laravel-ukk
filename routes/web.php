<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\StudentController;
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
        Route::get('/{classroom}', [ClassroomController::class, 'detail'])->name('detail');
    });

    Route::prefix('students')->name('students.')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('index');
        Route::get('/create', [StudentController::class, 'create'])->name('create');
        Route::post('/', [StudentController::class, 'store'])->name('store');
        Route::get('/{student}/edit', [StudentController::class, 'edit'])->name('edit');
        Route::put('/{student}', [StudentController::class, 'update'])->name('update');
        Route::delete('/{student}', [StudentController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('aspirations')->name('aspirations.')->group(function () {
        Route::get('/', [\App\Http\Controllers\AspirationController::class, 'index'])->name('index');
        Route::get('/{aspiration}', [\App\Http\Controllers\AspirationController::class, 'show'])->name('show');
        Route::get('/{aspiration}/edit', [\App\Http\Controllers\AspirationController::class, 'edit'])->name('edit');
        Route::put('/{aspiration}', [\App\Http\Controllers\AspirationController::class, 'update'])->name('update');
    });

});

Route::middleware(['auth', 'role:Siswa'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', function () {
        return view('student.dashboard');
    })->name('dashboard');

    Route::prefix('complaints')->name('complaints.')->group(function () {
        Route::get('/', [ComplaintController::class, 'index'])->name('index');
        Route::get('/create', [ComplaintController::class, 'create'])->name('create');
        Route::post('/', [ComplaintController::class, 'store'])->name('store');
        Route::get('/{complaint}', [ComplaintController::class, 'show'])->name('show');
        Route::get('/{complaint}/edit', [ComplaintController::class, 'edit'])->name('edit');
        Route::put('/{complaint}', [ComplaintController::class, 'update'])->name('update');
        Route::delete('/{complaint}', [ComplaintController::class, 'destroy'])->name('destroy');
    });

});



require __DIR__ . '/settings.php';
