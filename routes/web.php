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
    // Ruta para mostrar el formulario de creación de usuario
    Route::get('usuarios/crearUsuario', 'createUserController@getIndex')->name('usuarios.create');
    
    // Ruta para procesar el formulario de creación de usuario
    Route::post('crearUsuario', 'UserController@getIndex')->name('usuarios.store');
    
    // Ruta para mostrar el formulario de edición de usuario
    Route::get('usuarios/editar', 'createUserController@getIndex')->name('usuarios.edit');
    
    // Ruta para actualizar un usuario
    Route::put('usuarios/modificar', 'createUserController@getIndex')->name('usuarios.update');
    
    // Ruta para eliminar un usuario
    Route::delete('usuarios/eliminar', 'createUserController@getIndex')->name('usuarios.destroy');
});


Route::group(['middleware' => ['auth', 'role:jefe']], function () {
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');
});

Route::group(['middleware' => ['auth', 'role:trabajador']], function () {
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');
});

require __DIR__.'/auth.php';
