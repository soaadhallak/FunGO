<?php

namespace Database\Factories;

use App\Models\Place;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TripPlace>
 */
class TripPlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tripId=Trip::pluck('id');
        $placeId=Place::pluck('id');
        return [
            'trip_id'=>$tripId->random(),
            'place_id'=>$placeId->random(),
        ];
    }
}
