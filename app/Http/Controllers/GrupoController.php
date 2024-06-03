<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GrupoController extends Controller
{
    public function index()
    {
        $grupos = Group::with('users')->get();
        return view('group.index', compact('grupos'));
    }

    public function create()
    {
        $users = User::all();
        return view('group.create_group', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:25',
            'description' => 'nullable|string|max:100',
        ]);

        $grupo = Group::create($request->only('name', 'description'));

        return redirect()->route('group.index')->with('success', 'Grupo creado exitosamente.');
    }

    public function addUsers($id)
    {
        // Obtener el grupo
        $grupo = Group::findOrFail($id);

        // Obtener usuarios con el rol de "trabajador"
        $trabajadores = User::where('role_id', 3)->get();

        return view('group.add_user_group', compact('grupo', 'trabajadores'));
    }


    public function storeUsers(Request $request, $id)
    {
        // Validar la entrada
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        // Obtener el grupo
        $grupo = Group::findOrFail($id);

        // Obtener los IDs de los usuarios seleccionados
        $userIds = $request->input('user_ids');

        // Asignar el group_id a los usuarios seleccionados
        User::whereIn('id', $userIds)->update(['group_id' => $id]);

        return redirect()->route('group.index')->with('success', 'Usuarios agregados exitosamente al grupo.');
    }

    public function destroy(Group $grupo)
    {
        $grupoId3 = Group::find(3); // Obtener el grupo con ID 3

        // Transferir los usuarios al grupo con ID 3 si el grupo actual tiene usuarios
        if ($grupo->users()->count() > 0) {
            $grupoId3->users()->saveMany($grupo->users);
        }

        $grupo->delete();

        return redirect()->route('group.index')->with('success', 'Grupo eliminado exitosamente.');
    }
}
