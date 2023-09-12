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

        $nb_images = random_int(1, 4);
        $image_source = ['https://placedog.net/480/480?random', 'https://placekitten.com/480/480?image=', 'https://generatorfun.com/code/uploads/Random-Horse-image-'];

        $pet_images = [];

        for ($i = 0; $i < $nb_images; $i++) {
            $index_source = random_int(0, 1);
            if ($race->name == "cat") {
                array_push($pet_images, $image_source[1] . random_int(1, 16));
            } 
            if ($race->name == "horse") {
                array_push($pet_images, $image_source[2] . random_int(1, 19) . '.jpg');
            } else {
                array_push($pet_images, $image_source[0]);
            }
        }

        return [
            'uuid' => Str::uuid(),
            'user_id' => $user->id,
            'race_id' => $race->id,

            'sub_race' => SubRace::inRandomOrder()->where('race_id', $this->faker->numberBetween(1, 2))->first()->id,
            'gender_id' => $gender->id,
            'offer_type_id' => $offer_type->id,
            'price' => $this->faker->randomFloat(2, 0, 1000),

            'name' => $this->faker->name,
            'location' => $this->faker->address,
            'wilaya_id' => $wilaya->id,
            'wilaya_name' => $wilaya->name,
            'images' => json_encode($pet_images),

            'birthday' => $this->faker->date(),
            'color' => $this->faker->colorName,
            'weight' => $this->faker->randomFloat(2, 0, 100),
            'description' => $this->faker->text,
            'phone_number' => $user->phone_number,

            'keywords' => implode(',', $this->faker->words(5)),
        ];
    }
}
