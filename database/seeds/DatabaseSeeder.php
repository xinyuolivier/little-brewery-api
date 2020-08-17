<?php

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
        $this->call(BreweryTableSeeder::class);
        $this->call(BeerTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
