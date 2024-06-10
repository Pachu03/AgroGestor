<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RainsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('rains')->insert([
            ['date' => '2024-01-01', 'quanti_MM' => 12.5, 'localiti' => 'Sevilla', 'user_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['date' => '2024-01-15', 'quanti_MM' => 8.0, 'localiti' => 'Córdoba', 'user_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['date' => '2024-02-10', 'quanti_MM' => 20.3, 'localiti' => 'Granada', 'user_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['date' => '2024-02-25', 'quanti_MM' => 5.2, 'localiti' => 'Málaga', 'user_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['date' => '2024-03-05', 'quanti_MM' => 15.6, 'localiti' => 'Jaén', 'user_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['date' => '2024-03-20', 'quanti_MM' => 10.1, 'localiti' => 'Huelva', 'user_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['date' => '2024-04-10', 'quanti_MM' => 18.4, 'localiti' => 'Almería', 'user_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['date' => '2024-04-25', 'quanti_MM' => 22.9, 'localiti' => 'Sevilla', 'user_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['date' => '2024-05-10', 'quanti_MM' => 9.5, 'localiti' => 'Córdoba', 'user_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['date' => '2024-05-25', 'quanti_MM' => 14.7, 'localiti' => 'Granada', 'user_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['date' => '2024-06-05', 'quanti_MM' => 11.3, 'localiti' => 'Málaga', 'user_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['date' => '2024-06-20', 'quanti_MM' => 17.6, 'localiti' => 'Jaén', 'user_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['date' => '2024-07-10', 'quanti_MM' => 13.2, 'localiti' => 'Huelva', 'user_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['date' => '2024-07-25', 'quanti_MM' => 19.9, 'localiti' => 'Almería', 'user_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['date' => '2024-08-10', 'quanti_MM' => 16.0, 'localiti' => 'Sevilla', 'user_id' => 5, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
