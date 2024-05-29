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

        return view('filtrar_lluvia', compact('rains'));
    }

    public function createRain()
    {
        $minDate = Carbon::now()->startOfYear()->toDateString();
        return view('registrar_lluvia', compact('minDate'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required|date|after_or_equal:' . Carbon::now()->startOfYear()->toDateString(),
            'quanti_MM' => 'required|numeric|min:0|max:1000',
            'localiti' => 'required|string|max:255',
        ]);

        $validatedData['user_id'] = Auth::id();

        Rains::create($validatedData);

        return redirect()->route('rains.index')->with('success', 'Lluvia registrada exitosamente.');
    }
}
