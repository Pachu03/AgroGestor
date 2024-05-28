<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class CreateUserController extends Controller
{
    public function getIndex()
    {
        return view('admin.createUser');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
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
            $user->password = Hash::make($validatedData['password']);
            $user->role_id = $roleIds[$validatedData['role']];
            $user->save();

            // Asignar el rol al usuario
            $role = Role::find($user->role_id);
            if ($role) {
                $user->assignRole($role->name);
            }

            return redirect()->route('usuarios.crear')->with('success', 'Usuario creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('usuarios.crear')->with('error', 'Hubo un problema al crear el usuario.');
        }
    }
}
