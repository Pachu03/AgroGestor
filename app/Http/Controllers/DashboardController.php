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
            return view('dashboard.admin');
        } elseif ($user->hasRole('jefe')) {
            return view('dashboard.jefe');
        } elseif ($user->hasRole('trabajador')) {
            return view('dashboard.trabajador');
        }

        // Redirigir a una vista predeterminada si no tiene un rol específico
        return redirect('/home');
    }
}
