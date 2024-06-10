<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitiesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('activities')->insert([
            [
                'type_activity' => 'Siembra',
                'description' => 'Siembra de trigo',
                'start_date' => '2024-03-01',
                'end_date' => '2024-03-10',
                'state_activity' => true,
                'worker_user_id' => 5,
                'boss_user_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type_activity' => 'Riego',
                'description' => 'Riego de naranjas',
                'start_date' => '2024-04-05',
                'end_date' => '2024-04-07',
                'state_activity' => false,
                'worker_user_id' => 3,
                'boss_user_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type_activity' => 'Poda',
                'description' => 'Poda de olivos',
                'start_date' => '2024-06-10',
                'end_date' => '2024-06-20',
                'state_activity' => true,
                'worker_user_id' => 5,
                'boss_user_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type_activity' => 'Poda',
                'description' => 'Poda de viñedos',
                'start_date' => '2024-05-15',
                'end_date' => '2024-05-17',
                'state_activity' => false,
                'worker_user_id' => 6,
                'boss_user_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type_activity' => 'Fertilización',
                'description' => 'Fertilización de tomates',
                'start_date' => '2024-07-01',
                'end_date' => '2024-07-03',
                'state_activity' => true,
                'worker_user_id' => 7,
                'boss_user_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
