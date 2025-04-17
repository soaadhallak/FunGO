<?php

namespace Database\Factories;

use App\Models\Place;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Story>
 */
class StoryFactory extends Factory
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
        return [
            'txt'=>fake()->text(),
            'place_id'=>$placeId->random(),
            'user_id'=>$userId->random(),
        ];
    }
}
