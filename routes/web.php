<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\ModifyUserController;
use App\Http\Controllers\DeleteUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\RegistrarLluviaController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\CosechaController;
use App\Http\Controllers\InformeController;

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
    Route::get('usuarios/editar', [ModifyUserController::class, 'getIndex'])->name('usuarios.editar');

    // Ruta para mostrar el formulario de edición de usuario
    Route::get('usuarios/{id}/editar', [ModifyUserController::class, 'edit'])->name('usuarios.edit');

    // Ruta para actualizar un usuario
    Route::put('usuarios/{id}', [ModifyUserController::class, 'update'])->name('usuarios.update');

    // Ruta para eliminar un usuario
    Route::delete('usuarios/{id}', [DeleteUserController::class, 'destroy'])->name('usuarios.eliminar');
});

Route::get('/rains', [RegistrarLluviaController::class, 'getIndex'])->name('rains.index');
Route::get('lluvia/crear', [RegistrarLluviaController::class, 'createRain'])->name('rains.create');
Route::post('lluvia/listar', [RegistrarLluviaController::class, 'store'])->name('rains.store');

Route::group(['middleware' => ['auth', 'App\Http\Middleware\CheckRole:jefe']], function () {
    Route::get('/grupos', [GrupoController::class, 'index'])->name('group.index');
    Route::get('/grupos/crear', [GrupoController::class, 'create'])->name('group.create');
    Route::post('/grupos', [GrupoController::class, 'store'])->name('group.store');
    Route::get('/grupos/{id}/agregar-usuarios', [GrupoController::class, 'addUsers'])->name('group.add-user');
    Route::post('/grupos/{id}/agregar-usuarios', [GrupoController::class, 'storeUsers'])->name('group.save-user');

    // Rutas para actividades
    Route::get('/actividades/crear', [ActividadController::class, 'create'])->name('activity.create');
    Route::post('/actividades', [ActividadController::class, 'store'])->name('activity.store');
    Route::get('/actividades', [ActividadController::class, 'index'])->name('activity.index');

    // Ruta para registrar cosechas
    Route::get('/cosechas/registrar', [CosechaController::class, 'create'])->name('cosecha.registrar');
    Route::post('/cosechas', [CosechaController::class, 'store'])->name('cosecha.store');

    // Ruta para ver y generar informes
    Route::get('/informes', [InformeController::class, 'index'])->name('informe.ver');
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

Route::group(['middleware' => ['auth', 'App\Http\Middleware\CheckRole:trabajador']], function () {
    //Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');
});

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

require __DIR__ . '/auth.php';
