<?php

use Illuminate\Database\Seeder;
use App\Beer;

class BeerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Beer::class, 50)->create();
    }
}
