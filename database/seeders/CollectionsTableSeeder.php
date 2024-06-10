<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollectionsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('collections')->insert([
            [
                'date_collection' => '2024-06-20',
                'quantity_collection' => 500,
                'product_id' => 1,
                'group_id' => 4,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'date_collection' => '2024-07-10',
                'quantity_collection' => 300,
                'product_id' => 2,
                'group_id' => 5,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'date_collection' => '2024-07-20',
                'quantity_collection' => 400,
                'product_id' => 3,
                'group_id' => 5,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'date_collection' => '2024-08-01',
                'quantity_collection' => 600,
                'product_id' => 4,
                'group_id' => 4,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'date_collection' => '2024-08-15',
                'quantity_collection' => 350,
                'product_id' => 5,
                'group_id' => 4,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
