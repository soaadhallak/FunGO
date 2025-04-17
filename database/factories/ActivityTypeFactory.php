<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ActivityType>
 */
class ActivityTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $activityType=['مطعم', 'كافيه', 'ألعاب', 'تسوق', 'سينما'];
        return [
            'name'=>fake()->randomElement($activityType),
        ];
    }
}
