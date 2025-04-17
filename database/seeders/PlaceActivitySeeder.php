<?php

namespace Database\Seeders;

use App\Models\placeActivity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlaceActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        placeActivity::factory(20)->create();
    }
}
