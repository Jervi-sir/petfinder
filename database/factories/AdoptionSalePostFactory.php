<?php

namespace Database\Factories;

use App\Models\Pet;
use App\Models\OfferType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdoptionSalePost>
 */
class AdoptionSalePostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $offer_id = OfferType::inRandomOrder()->first()->id;
        $price = null;
        if($offer_id != 1 ) {
            $price = '';
        }
        return [
            'pet_id' => Pet::inRandomOrder()->first()->id,
            'offer_type_id' => $offer_id,
            'is_active' => $this->faker->boolean,
            'last_date_activated' => $this->faker->dateTime(),
        ];
    }
}
