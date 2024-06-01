<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:20',
            'description' => 'nullable|string',
        ]);

        // Crear la cosecha
        $producto = Product::create($request->only('name', 'description'));

        return redirect()->route('harvest.register')->with('success', 'Producto registrado');
    }
}
