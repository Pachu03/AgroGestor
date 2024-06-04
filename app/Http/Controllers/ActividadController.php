<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\User;

class ActividadController extends Controller
{

    public function index()
    {
        // Obtener el ID del usuario actualmente autenticado
        $userId = auth()->id();

        // Obtener las actividades donde el usuario es el jefe
        $actividades = Activity::where('boss_user_id', $userId)->paginate(5);

        return view('dashboard.jefe', compact('actividades'));
    }


    /**
     * Show the form for creating a new activity.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trabajadores = User::where('role_id', 3)->get();
        $boss = auth()->user()->id;
        return view('activity.create_activity', compact('trabajadores', 'boss'));
    }

    /**
     * Store a newly created activity in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'type_activity' => 'required|string',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'state_activity' => 'required|boolean',
            'worker_user_id' => 'required|exists:users,id',
        ]);

        $userId = auth()->id();

        Activity::create([
            'type_activity' => $request->type_activity,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'state_activity' => $request->state_activity,
            'worker_user_id' => $request->worker_user_id,
            'boss_user_id' => $userId,
        ]);

        return redirect()->route('activity.index')->with('success', 'Actividad creada exitosamente.');
    }
}
