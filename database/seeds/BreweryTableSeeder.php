<?php

use Illuminate\Database\Seeder;
use App\Brewery;

class BreweryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Brewery::class, 10)->create();
    }
}
