<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::resource('users', UserController::class);
});

Route::group(['middleware' => ['auth', 'role:jefe']], function () {
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');
});

Route::group(['middleware' => ['auth', 'role:trabajador']], function () {
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');
});

require __DIR__.'/auth.php';
