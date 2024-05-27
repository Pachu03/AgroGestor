<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

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
        ]);

        // Asignar rol de administrador al usuario
        $admin->assignRole('admin');
    }
}
