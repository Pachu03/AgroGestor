<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class RolesAndAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Crear permisos con guard_name
        $permissions = [
            ['name' => 'crear usuarios', 'guard_name' => 'web'],
            ['name' => 'eliminar usuarios', 'guard_name' => 'web'],
            ['name' => 'modificar usuarios', 'guard_name' => 'web'],
        ];

        foreach ($permissions as $permissionData) {
            Permission::firstOrCreate($permissionData);
        }

        // Crear roles
        $roles = ['admin', 'jefe', 'trabajador'];

        foreach ($roles as $roleName) {
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);

            // Asignar permisos al rol de administrador
            if ($roleName == 'admin') {
                $role->givePermissionTo(['crear usuarios', 'eliminar usuarios', 'modificar usuarios']);
            }
        }

        // Crear usuario administrador
        $admin = User::firstOrCreate([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'group_id' => '1'
        ]);

        // Asignar rol de administrador al usuario
        $result = $admin->assignRole('admin');

        if (!$result) {
            // Manejar el error si el rol no se pudo asignar
            Log::error("Error al asignar el rol 'admin' al usuario {$admin->id}");
        } else {
            Log::info("Rol 'admin' asignado exitosamente al usuario {$admin->id}");
        }
    }
}
