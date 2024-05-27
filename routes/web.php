<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => ['auth', 'App\Http\Middleware\CheckRole:admin']], function () {
    // Ruta para mostrar el formulario de creación de usuario
    Route::get('usuarios/crear', [CreateUserController::class, 'getIndex'])->name('usuarios.crear');

    // Ruta para procesar el formulario de creación de usuario
    Route::post('usuarios/crear', [CreateUserController::class, 'store'])->name('usuarios.store');
    
    // Ruta para mostrar el formulario de edición de usuario
    Route::get('usuarios/editar', [CreateUserController::class, 'edit'])->name('usuarios.edit');
    
    // Ruta para actualizar un usuario
    Route::put('usuarios/editar', [CreateUserController::class, 'update'])->name('usuarios.update');
    
    // Ruta para eliminar un usuario
    Route::delete('usuarios/eliminar', [CreateUserController::class, 'destroy'])->name('usuarios.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::group(['middleware' => ['auth', 'App\Http\Middleware\CheckRole:jefe']], function () {
    //Route::get('/reports', [ReportController::class, 'index'])->name('reports');
    Route::get('hola', [CreateUserController::class, 'getIndex'])->name('hola');
});

Route::group(['middleware' => ['auth', 'role:trabajador']], function () {
    //Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');
});

require __DIR__.'/auth.php';
