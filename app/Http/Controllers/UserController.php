<?php

namespace App\Http\Controllers;

use App\Mail\UserCreatedMail;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use Swift_TransportException;

class UserController extends Controller
{
    public function getIndexCreate()
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
            $validatedData = $request->validate([
                'name' => 'required|string|max:25',
                'email' => 'required|string|email|max:40|unique:users',
                'password' => 'required|string|min:8',
                'role' => 'required|string|in:jefe,trabajador',
            ]);

            $roleIds = [
                'jefe' => 2,
                'trabajador' => 3,
            ];

            $user = new User();
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $password = $validatedData['password'];
            $user->password = Hash::make($password);
            $user->role_id = $roleIds[$validatedData['role']];
            $user->group_id = $roleIds[$validatedData['role']];
            $user->save();

            $role = Role::find($user->role_id);
            if ($role) {
                $user->assignRole($role->name);
            }

            return redirect()->route('usuarios.crear')->with('success', 'Usuario creado exitosamente.');
        } catch (ValidationException $e) {
            $errors = $e->validator->errors();
            if ($errors->has('email')) {
                return redirect()->route('usuarios.crear')->withErrors(['email' => 'El correo electrónico ya está registrado.'])->withInput();
            }
            return redirect()->route('usuarios.crear')->withErrors($errors)->withInput();
        } catch (\Exception $e) {
            return redirect()->route('usuarios.crear')->with('error', 'Hubo un problema al crear el usuario: ' . $e->getMessage());
        }
    }



    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndexModify()
    {
        try {
            $users = User::whereHas('roles', function ($query) {
                $query->whereIn('id', [2, 3]);
            })->paginate(5); 

            // Pasar la lista de usuarios filtrados y paginados a la vista
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
            $user->group_id = $roleIds[$validatedData['role']];
            $user->save();

            $user->syncRoles([$validatedData['role']]);

            return redirect()->route('usuarios.editar')->with('success', 'Usuario actualizado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('usuarios.editar')->with('error', 'Hubo un problema al actualizar el usuario.');
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('usuarios.editar')->with('success', 'Usuario eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('usuarios.editar')->with('error', 'Hubo un problema al eliminar el usuario.');
        }
    }
}
