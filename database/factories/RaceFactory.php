<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Race>
 */
class RaceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'details' => $this->faker->sentence,
        ];
    }
}
