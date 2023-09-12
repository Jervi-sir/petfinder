<?php

namespace Database\Factories;

use App\Models\Pet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostMetadata>
 */
class PostMetadataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pet_id' => Pet::inRandomOrder()->first()->id,
            'views' => $this->faker->numberBetween(0, 10000),
            'likes' => $this->faker->numberBetween(0, 1000),
            'shares' => $this->faker->numberBetween(0, 100),
            'favorites' => $this->faker->numberBetween(0, 100),
        ];
    }
}
