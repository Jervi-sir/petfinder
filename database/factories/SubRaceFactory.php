<?php

namespace Database\Factories;

use App\Models\Race;
use App\Models\SubRace;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubRace>
 */
class SubRaceFactory extends Factory
{
    protected $model = SubRace::class;

    public function definition(): array
    {
        return [
            'race_id' => Race::inRandomOrder()->first()->id,
            'name' => $this->faker->word,
            'details' => $this->faker->sentence,
        ];
    }
}
