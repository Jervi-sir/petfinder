<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Pet;
use App\Models\Race;
use App\Models\Save;
use App\Models\User;
use App\Models\Wilaya;
use App\Models\SubRace;
use App\Models\PetImage;
use App\Models\OfferType;
use App\Models\MediaService;
use Database\Seeders\TagSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\RaceSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\ColorSeeder;
use Database\Seeders\GenderSeeder;
use Database\Seeders\WilayaSeeder;
use Database\Seeders\OfferTypeSeeder;
use Database\Seeders\TranslationSeeder;
use Database\Seeders\MediaServiceSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = new RoleSeeder();
        $roles->run();

        $media = new MediaServiceSeeder();
        $media->run();

        Race::factory(11)->create();
        SubRace::factory(60)->create();

        Wilaya::factory(58)->create();

        $offerType = new OfferTypeSeeder();
        $offerType->run();

        $gender = new GenderSeeder();
        $gender->run();

        User::factory(100)->create();
        Pet::factory(200)->create();
        //PetImage::factory(256)->create();
        Save::factory(210)->create();
    }
}
