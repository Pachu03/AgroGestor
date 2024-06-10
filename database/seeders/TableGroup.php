<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableGroup extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            ['name' => 'Administradores', 'description' => 'Grupo en el que se encuentra los Administradores del Sistema', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jefes', 'description' => 'Grupo en el que se encuentra los Jefes del Sistema', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Trabajadores', 'description' => 'Grupo en el que se encuentra los Trabajadores del Sistema que se crean.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Recogida', 'description' => 'Grupo para la recogida de productos.', 'created_at' => now(), 'updated_at' => now()],

        ]);
    }
}
