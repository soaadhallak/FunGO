<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Place>
 */
class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->company(),
            'address'=>fake()->address(),
            'description'=>fake()->sentence(),
            'latitude'=>fake()->latitude(33.4,36.4),
            'longitude'=>fake()->longitude(33.4,36.4),
        ];
    }
}
