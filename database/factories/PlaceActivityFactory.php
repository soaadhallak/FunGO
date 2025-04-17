<?php

namespace Database\Factories;

use App\Models\ActivityType;
use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PlaceActivity>
 */
class PlaceActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $placeId=Place::pluck('id');
        $activityTypeId=ActivityType::pluck('id');
        return [
            'place_id'=>$placeId->random(),
            'activity_type_id'=>$activityTypeId->random(),
            'min_price'=>fake()->numberBetween(5000,9000),
            'max_price'=>fake()->numberBetween(5000,9000),
        ];
    }
}
