<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return redirect()->route('usuarios.editar');
        } elseif ($user->hasRole('jefe')) {
            return redirect()->route('activity.index');
        } elseif ($user->hasRole('trabajador')) {
            return redirect()->route('task.index');
        }

        // Redirigir a una vista predeterminada si no tiene un rol específico
        return redirect('/home');
    }
}
