<?php

namespace Database\Factories;

use App\Models\Gender;
use App\Models\OfferType;
use App\Models\Pet;
use App\Models\Race;
use App\Models\SubRace;
use App\Models\User;
use App\Models\Wilaya;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    protected $model = Pet::class;

    public function definition(): array
    {
        $wilaya = Wilaya::inRandomOrder()->first();
        $offer_type = OfferType::inRandomOrder()->first();
        $gender = Gender::inRandomOrder()->first();
        $race = Race::inRandomOrder()->first();
        $user = User::inRandomOrder()->first();

        return [
            'uuid' => Str::uuid(),
            'user_id' => $user->id,
            'race_id' => $race->id,

            'sub_race' => SubRace::where('race_id', $race->id)->get()->random()->id,
            'gender_id' => $gender->id,
            'offer_type_id' => $offer_type->id,
            'price' => $this->faker->randomFloat(2, 0, 1000),

            'name' => $this->faker->name,
            'location' => $this->faker->address,
            'wilaya_id' => $wilaya->id,
            'wilaya_name' => $wilaya->name,

            'birthday' => $this->faker->date(),
            'color' => $this->faker->colorName,
            'weight' => $this->faker->randomFloat(2, 0, 100),
            'description' => $this->faker->text,
            'phone_number' => $user->phone_number,

            'is_active' => $this->faker->boolean,
            'last_date_activated' => $this->faker->dateTime(),
            'keywords' => implode(',', $this->faker->words(5)),
        ];
    }
}
