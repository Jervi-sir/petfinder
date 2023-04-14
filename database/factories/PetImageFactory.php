<?php

namespace Database\Factories;

use App\Models\Pet;
use App\Models\PetImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PetImage>
 */
class PetImageFactory extends Factory
{
    protected $model = PetImage::class;

    public function definition(): array
    {
        return [
            'pet_id' => Pet::inRandomOrder()->first()->id,
            'image_url' => $this->faker->imageUrl(480, 480),
            'meta' => json_encode([
                'width' => $this->faker->numberBetween(200, 1000),
                'height' => $this->faker->numberBetween(200, 1000),
                'format' => 'png',
            ]),
        ];
    }
}
