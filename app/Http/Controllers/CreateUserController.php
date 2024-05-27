<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CreateUserController extends Controller
{

    public function getIndex()
    {
        return view("admin.createUser");
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:jefe,trabajador',
        ]);

        // Definir los IDs de roles
        $roleIds = [
            'jefe' => 2,
            'trabajador' => 3,
        ];

        // Crear el nuevo usuario
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']);
        $user->save();

        // Asignar el rol al usuario
        $user->assignRole($roleIds[$validatedData['role']]);

        // Redirigir a alguna vista o ruta después de crear el usuario
        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente.');
    }
}
