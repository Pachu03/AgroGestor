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

        // Crear roles con IDs específicos
        $roles = [
            ['id' => 1, 'name' => 'admin', 'guard_name' => 'web'],
            ['id' => 2, 'name' => 'jefe', 'guard_name' => 'web'],
            ['id' => 3, 'name' => 'trabajador', 'guard_name' => 'web']
        ];

        foreach ($roles as $roleData) {
            $role = Role::firstOrCreate(['id' => $roleData['id']], ['name' => $roleData['name'], 'guard_name' => $roleData['guard_name']]);

            // Asignar permisos al rol de administrador
            if ($roleData['name'] == 'admin') {
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
        if ($admin->exists) {
            $admin->assignRole('admin');
            $admin->role_id = 1;
            $admin->save();
        }

        // Crear usuario jefe
        $jefe = User::firstOrCreate([
            'name' => 'Carlos Martínez',
            'email' => 'carlos.martinez@empresa.com',
            'password' => bcrypt('carlosjefe'),
            'group_id' => '2'
        ]);

        // Asignar rol de jefe al usuario
        if ($jefe->exists) {
            $jefe->assignRole('jefe');
            $jefe->role_id = 2;
            $jefe->save();
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
                'group_id' => '4'
            ]);

            // Asignar rol de trabajador al usuario
            if ($trabajador->exists) {
                $trabajador->assignRole('trabajador');
                $trabajador->role_id = 3;
                $trabajador->save();
            }
        }
    }
}
