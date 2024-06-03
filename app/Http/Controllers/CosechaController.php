<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\Product;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;

class CosechaController extends Controller
{
    public function create()
    {
        // Obtener todos los productos
        $productos = Product::all();

        // Obtener todos los grupos excepto los tres primeros
        $grupos = Group::where('id', '>', 3)->get();

        // Filtrar los grupos que tienen al menos un usuario
        $gruposValidos = $grupos->filter(function ($grupo) {
            return $grupo->users()->exists();
        });

        return view('harvest.create', compact('productos', 'gruposValidos'));
    }

    public function store(Request $request)
    {
        // Validar la entrada
        $request->validate([
            'date_collection' => 'required|date',
            'quantity_collection' => 'required|numeric|min:1|max:10000',
            'product_id' => 'required|exists:products,id',
            'group_id' => 'required|exists:groups,id'
        ]);

        // Crear la cosecha
        Collection::create([
            'date_collection' => $request->date_collection,
            'quantity_collection' => $request->quantity_collection,
            'product_id' => $request->product_id,
            'group_id' => $request->group_id,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('harvest.register')->with('success', 'Cosecha registrada exitosamente.');
    }
}
