<?php

namespace Database\Seeders;

use App\Models\TripPlace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TripPlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TripPlace::factory(25)->create();
    }
}
