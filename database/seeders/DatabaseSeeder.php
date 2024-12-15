<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CategoriesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();



        $this->call([

            AdminSeeder::class,
            UserSeeder::class,
            CategoriesSeeder::class,
            RolesAndPermissionsSeeder::class,
            UserRolesAndPermissionsSeeder::class,
        ]);
    }
}
