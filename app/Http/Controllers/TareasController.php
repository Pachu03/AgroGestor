<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;

class TareasController extends Controller
{
    public function index()
    {
        // Obtener las actividades del usuario actual que no están terminadas
        $activities = Activity::where('worker_user_id', auth()->id())
            ->where('state_activity', 1)
            ->paginate(5);


        return view('dashboard.trabajador', compact('activities'));
    }

    public function history()
    {
        // Obtener el historial de actividades del usuario actual
        $history = Activity::where('worker_user_id', auth()->id())
            ->where('state_activity', 0)
            ->get();

        return view('task.history', compact('history'));
    }

    public function finishActivity(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'activity_id' => 'required|exists:activities,id'
        ]);

        // Marcar la actividad como terminada (cambiar el estado a 1)
        $activity = Activity::findOrFail($request->activity_id);
        $activity->state_activity = 0;
        $activity->save();

        return redirect()->route('task.index')->with('success', '¡Actividad marcada como terminada correctamente!');
    }
}
