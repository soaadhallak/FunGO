<?php

namespace Database\Seeders;

use App\Models\ActivityType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ActivityType::factory(5)->create();
    }
}
