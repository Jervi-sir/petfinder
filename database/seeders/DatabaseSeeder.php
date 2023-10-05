<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Pet;
use App\Models\Tag;
use App\Models\Race;
use App\Models\Save;
use App\Models\User;
use App\Models\Color;
use App\Models\Wilaya;
use App\Models\PetLost;
use App\Models\SubRace;
use App\Models\PetImage;
use App\Models\OfferType;
use App\Models\LostPetPost;
use App\Models\PetMetadata;
use App\Models\MediaService;
use App\Models\PostMetadata;
use App\Models\PetLostMetadata;
use Database\Seeders\TagSeeder;
use Illuminate\Database\Seeder;
use App\Models\AdoptionSalePost;
use Database\Seeders\RaceSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\ColorSeeder;
use Database\Seeders\GenderSeeder;
use Database\Seeders\WilayaSeeder;
use Database\Seeders\SubRacesSeeder;
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

        $gender = new GenderSeeder();
        $gender->run();

        $wilaya = new WilayaSeeder();
        $wilaya->run();

        $media = new MediaServiceSeeder();
        $media->run();

        $offerType = new OfferTypeSeeder();
        $offerType->run();
        
        User::factory(100)->create();

        Color::factory(60)->create();

        Tag::factory(60)->create();

        $translations = new TranslationSeeder();
        $translations->run();



        $race = new RaceSeeder();
        $race->run();
        
        $subRace = new SubRacesSeeder();
        $subRace->run();

        Pet::factory(669)->create();
        PetLost::factory(600)->create();
        PetMetadata::factory(669)->create();
        PetLostMetadata::factory(600)->create();

        Save::factory(1000)->create();

        //PetImage::factory(256)->create();
    }
}
