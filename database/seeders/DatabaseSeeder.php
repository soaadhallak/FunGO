<?php

namespace Database\Seeders;

use App\Models\TripPlace;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->create();
        $this->call([
            PlaceSeeder::class,
            ActivityTypeSeeder::class,
            PlaceActivitySeeder::class,
            LocationSeeder::class,
            ReviewSeeder::class,
            SaleSeeder::class,
            StorySeeder::class,
            TripSeeder::class,
            TripPlaceSeeder::class,
        ]);

    }
}
