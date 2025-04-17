<?php

namespace Database\Factories;

use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $placeId=Place::pluck('id');
        return [
            'title'=>fake()->title(),
            'date_start' => fake()->dateTimeBetween('-3 days', '+3 days')->format('Y-m-d'),
            'date_end' => fake()->dateTimeBetween('+4 days', '+10 days')->format('Y-m-d'),
            'place_id'=>$placeId->random(),
        ];
    }
}
