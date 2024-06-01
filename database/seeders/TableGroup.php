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
    public function run(): void
    {
        DB::table('groups')->insert([
            ['name' => 'Administradores', 'description' => 'Grupo en el que se encuentra los Administradores del Sistema'],
            ['name' => 'Jefes', 'description' => 'Grupo en el que se encuentra los Jefes del Sistema'],
            ['name' => 'Trabajadores', 'description' => 'Grupo en el que se encuentra los Trabajadores del Sistema que se crean.'],
        ]);
    }
}
