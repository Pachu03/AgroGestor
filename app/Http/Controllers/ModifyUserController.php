<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class ModifyUserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        try {
            $users = User::with('roles')->get();
            return view('admin.listUser', compact('users'));
        } catch (\Exception $e) {
            return redirect()->route('usuarios.editar')->with('error', 'Hubo un problema al cargar la lista de usuarios.');
        }
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $user = User::findOrFail($id);
            $roles = Role::all();
            return view('admin.editUser', compact('user', 'roles'));
        } catch (\Exception $e) {
            return redirect()->route('usuarios.editar')->with('error', 'Hubo un problema al cargar el formulario de edición de usuario.');
        }
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $id,
                'password' => 'nullable|string|min:8',
                'role' => 'required|string|in:jefe,trabajador',
            ]);

            $user = User::findOrFail($id);
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            if (!empty($validatedData['password'])) {
                $user->password = Hash::make($validatedData['password']);
            }

            $roleIds = [
                'jefe' => 2,
                'trabajador' => 3,
            ];
            $user->role_id = $roleIds[$validatedData['role']];
            $user->save();

            $user->syncRoles([$validatedData['role']]);

            return redirect()->route('usuarios.editar')->with('success', 'Usuario actualizado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('usuarios.editar')->with('error', 'Hubo un problema al actualizar el usuario.');
        }
    }
}
