<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            TableGroup::class,
            RolesAndAdminSeeder::class,
            ProductsTableSeeder::class,
            ActivitiesTableSeeder::class,
            RainsTableSeeder::class,
            CollectionsTableSeeder::class,
        ]);
    }
}
