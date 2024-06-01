<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Rains;

class RegistrarLluviaController extends Controller
{
    public function getIndex(Request $request)
    {
        $query = Rains::with('user');

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('date', [$request->input('from_date'), $request->input('to_date')]);
        } else {
            if ($request->filled('from_date')) {
                $query->where('date', '>=', $request->input('from_date'));
            }

            if ($request->filled('to_date')) {
                $query->where('date', '<=', $request->input('to_date'));
            }
        }

        $rains = $query->get();

        return view('rain.filtrar_lluvia', compact('rains'));
    }

    public function createRain()
    {
        $minDate = Carbon::now()->startOfYear()->toDateString();
        return view('rain.registrar_lluvia', compact('minDate'));
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validatedData = $request->validate([
            'date' => ['required', 'date', 'after_or_equal:' . Carbon::now()->startOfYear()->toDateString()],
            'quanti_MM' => ['required', 'numeric', 'min:0', 'max:1000'],
            'localiti' => ['required', 'string', 'max:255'],
        ], [
            // Mensajes de error personalizados
            'date.required' => 'La fecha es obligatoria.',
            'date.date' => 'La fecha debe ser válida.',
            'date.after_or_equal' => 'La fecha debe ser igual o posterior a la fecha actual.',
            'quanti_MM.required' => 'La cantidad de milímetros de lluvia es obligatoria.',
            'quanti_MM.numeric' => 'La cantidad de milímetros de lluvia debe ser un número.',
            'quanti_MM.min' => 'La cantidad de milímetros de lluvia debe ser al menos :min.',
            'quanti_MM.max' => 'La cantidad de milímetros de lluvia no debe ser mayor a :max.',
            'localiti.required' => 'La localidad es obligatoria.',
            'localiti.string' => 'La localidad debe ser una cadena de caracteres.',
            'localiti.max' => 'La localidad no debe exceder los :max caracteres.',
        ]);

        // Asignar el ID del usuario actual al campo user_id
        $validatedData['user_id'] = Auth::id();

        // Crear una nueva instancia de Rains con los datos validados y guardarla en la base de datos
        Rains::create($validatedData);

        // Redirigir al usuario a la vista rains.index con un mensaje de éxito
        return redirect()->route('rains.index')->with('success', 'Lluvia registrada exitosamente.');
    }
}
