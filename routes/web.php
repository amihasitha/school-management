<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\StudentsController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/teachers', [TeachersController::class, 'index'])
        ->name('teachers.index');

    Route::get('/teachers/{user}/edit', [TeachersController::class, 'edit'])
        ->name('teachers.edit');

    Route::put('/teachers/{user}', [TeachersController::class, 'update'])
        ->name('teachers.update');

    Route::delete('/teachers/{user}', [TeachersController::class, 'destroy'])
        ->name('teachers.destroy');    
});

Route::middleware('auth')->group(function () {
    Route::get('/students', [StudentsController::class, 'index'])
        ->name('students.index');
});

require __DIR__.'/auth.php';