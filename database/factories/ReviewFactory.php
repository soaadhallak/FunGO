<?php

namespace Database\Factories;

use App\Models\ActivityType;
use App\Models\Place;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $placeId=Place::pluck('id');
        $userId=User::pluck('id');
        $activityTypeId=ActivityType::pluck('id');
        return [
            'comment'=>fake()->sentence(),
            'rating'=>fake()->numberBetween(1,5),
            'place_id'=>$placeId->random(),
            'activity_type_id'=>$activityTypeId->random(),
            'user_id'=>$userId->random(), 
        ];
    }
}
