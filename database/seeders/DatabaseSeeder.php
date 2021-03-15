<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([   
            CountriesSeeder::class,
            StatesSeeder::class,     
            CitiesSeeder::class,             
            RolesSeeder::class,     
            UserSeeder::class,   
            SkillsSeeder::class,
            Documents_CategorySeeder::class,
        ]);
    }
}
