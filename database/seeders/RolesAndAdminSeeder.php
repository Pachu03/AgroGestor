<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolesAndAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Crear roles
        $roles = ['admin', 'jefe', 'trabajador'];

        foreach ($roles as $roleName) {
            Role::create(['name' => $roleName]);
        }

        // Crear usuario administrador
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin'), 
        ]);

        // Asignar rol de administrador al usuario
        $admin->assignRole('admin');
    }
}
