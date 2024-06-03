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

        // Crear usuario jefe
        $jefe = User::firstOrCreate([
            'name' => 'Carlos Martínez',
            'email' => 'carlos.martinez@empresa.com',
            'password' => bcrypt('carlosjefe'),
            'group_id' => '2'
        ]);

        // Asignar rol de jefe al usuario
        $result = $jefe->assignRole('jefe');

        if (!$result) {
            Log::error("Error al asignar el rol 'jefe' al usuario {$jefe->id}");
        } else {
            Log::info("Rol 'jefe' asignado exitosamente al usuario {$jefe->id}");
        }

        // Crear usuarios trabajadores
        $trabajadores = [
            ['name' => 'Ana López', 'email' => 'ana.lopez@empresa.com', 'password' => 'ana123'],
            ['name' => 'Luis Pérez', 'email' => 'luis.perez@empresa.com', 'password' => 'luis123'],
            ['name' => 'Marta Sánchez', 'email' => 'marta.sanchez@empresa.com', 'password' => 'marta123'],
            ['name' => 'Juan Gómez', 'email' => 'juan.gomez@empresa.com', 'password' => 'juan123'],
            ['name' => 'Elena Fernández', 'email' => 'elena.fernandez@empresa.com', 'password' => 'elena123'],
        ];

        foreach ($trabajadores as $trabajadorData) {
            $trabajador = User::firstOrCreate([
                'name' => $trabajadorData['name'],
                'email' => $trabajadorData['email'],
                'password' => bcrypt($trabajadorData['password']),
                'group_id' => '3'
            ]);

            // Asignar rol de trabajador al usuario
            $result = $trabajador->assignRole('trabajador');

            if (!$result) {
                Log::error("Error al asignar el rol 'trabajador' al usuario {$trabajador->id}");
            } else {
                Log::info("Rol 'trabajador' asignado exitosamente al usuario {$trabajador->id}");
            }
        }
    }
}
