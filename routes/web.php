<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\RegistrarLluviaController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\CosechaController;
use App\Http\Controllers\InformeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TareasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LanguageController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Ruta para cambiar el idioma
Route::get('lang/{locale}', [LanguageController::class, 'switchLang'])->name('lang.switch');

Route::group(['middleware' => ['auth', 'App\Http\Middleware\CheckRole:admin']], function () {
    // Ruta para mostrar el formulario de creación de usuario
    Route::get('usuarios/crear', [UserController::class, 'getIndexCreate'])->name('usuarios.crear');

    // Ruta para procesar el formulario de creación de usuario
    Route::post('usuarios/crear', [UserController::class, 'store'])->name('usuarios.store');

    // Ruta para mostrar el formulario de edición de usuario
    Route::get('usuarios/editar', [UserController::class, 'getIndexModify'])->name('usuarios.editar');

    // Ruta para mostrar el formulario de edición de usuario
    Route::get('usuarios/{id}/editar', [UserController::class, 'edit'])->name('usuarios.edit');

    // Ruta para actualizar un usuario
    Route::put('usuarios/{id}', [UserController::class, 'update'])->name('usuarios.update');

    // Ruta para eliminar un usuario
    Route::delete('usuarios/{id}', [UserController::class, 'destroy'])->name('usuarios.eliminar');
});

Route::get('lluvia', [RegistrarLluviaController::class, 'getIndex'])->name('rains.index');
Route::get('lluvia/crear', [RegistrarLluviaController::class, 'createRain'])->name('rains.create');
Route::post('lluvia/listar', [RegistrarLluviaController::class, 'store'])->name('rains.store');
Route::get('lluvia/localidades', [RegistrarLluviaController::class, 'postLocality'])->name('rain.localiti');

Route::group(['middleware' => ['auth', 'App\Http\Middleware\CheckRole:jefe']], function () {
    Route::get('grupos', [GrupoController::class, 'index'])->name('group.index');
    Route::get('grupos/crear', [GrupoController::class, 'create'])->name('group.create');
    Route::post('grupos', [GrupoController::class, 'store'])->name('group.store');
    Route::get('grupos/{id}/agregar-usuarios', [GrupoController::class, 'addUsers'])->name('group.add-user');
    Route::post('grupos/{id}/agregar-usuarios', [GrupoController::class, 'storeUsers'])->name('group.save-user');
    Route::get('group/{grupo}', [GrupoController::class, 'destroy'])->name('group.destroy');

    // Rutas para actividades
    Route::get('actividades/crear', [ActividadController::class, 'create'])->name('activity.create');
    Route::post('actividades', [ActividadController::class, 'store'])->name('activity.store');
    Route::get('actividades', [ActividadController::class, 'index'])->name('activity.index');

    // Ruta para registrar cosechas
    Route::get('cosechas/registrar', [CosechaController::class, 'create'])->name('harvest.register');
    Route::post('cosechas', [CosechaController::class, 'store'])->name('harvest.store');

    Route::get('producto/registrar', [ProductController::class, 'create'])->name('product.register');
    Route::post('producto', [ProductController::class, 'store'])->name('product.store');

    // Ruta para ver y generar informes
    Route::get('informes/seleccionar', [InformeController::class, 'selectHarvest'])->name('report.index');
    Route::post('informes/generar', [InformeController::class, 'generateReport'])->name('report.generate');
});

Route::group(['middleware' => ['auth', 'App\Http\Middleware\CheckRole:trabajador']], function () {
    Route::get('tareas', [TareasController::class, 'index'])->name('task.index');
    Route::post('tareas/finalizar', [TareasController::class, 'finishActivity'])->name('task.finish');
    Route::get('historial', [TareasController::class, 'history'])->name('task.history');
});

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

require __DIR__ . '/auth.php';
