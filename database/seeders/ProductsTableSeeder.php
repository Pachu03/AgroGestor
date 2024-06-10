<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            ['name' => 'Aceitunas', 'description' => 'Aceitunas frescas', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Naranjas', 'description' => 'Naranjas jugosas', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Manzanas', 'description' => 'Manzanas rojas', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Uvas', 'description' => 'Uvas para vino', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tomates', 'description' => 'Tomates maduros', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

