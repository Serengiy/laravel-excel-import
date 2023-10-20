<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [\App\Http\Controllers\ProjectController::class, 'index'])->middleware('auth');

Route::get('/dashboard', [\App\Http\Controllers\ProjectController::class, 'index'])->middleware(['auth'])->name('project.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/projects/import', [\App\Http\Controllers\ProjectController::class, 'import'])->name('project.import');
Route::post('/projects/import', [\App\Http\Controllers\ProjectController::class, 'importStore'])->name('project.import.store');
Route::get('/tasks', [\App\Http\Controllers\TaskController::class, 'index'])->name('task.index');
Route::get('/tasks/{task}/failedRows', [\App\Http\Controllers\TaskController::class, 'failedRows'])->name('task.failed');

require __DIR__.'/auth.php';
