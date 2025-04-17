<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId=User::pluck('id');
        return [
            'user_id'=>$userId->random(),
            'latitude'=>fake()->latitude(25.3,38.5),
            'longitude'=>fake()->longitude(25.6,30.2),

        ];
    }
}
