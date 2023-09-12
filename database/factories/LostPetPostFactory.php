<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Pet;
use App\Models\OfferType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LostPetPost>
 */
class LostPetPostFactory extends Factory
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
            'last_date_activated' => $this->faker->dateTimeBetween('-1 years', 'now'), 
        ];
    }
}
