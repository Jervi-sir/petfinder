<?php

namespace Database\Factories;

use App\Models\Wilaya;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wilaya>
 */
class WilayaFactory extends Factory
{
    protected $model = Wilaya::class;

    public function definition(): array
    {
        static $number = 1;

        return [
            'number' => $number++,
            'name' => $this->faker->word,
        ];
    }
}
