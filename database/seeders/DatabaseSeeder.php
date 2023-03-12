<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\OfferType;
use Database\Seeders\TagSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\RaceSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\ColorSeeder;
use Database\Seeders\WilayaSeeder;
use Database\Seeders\TranslationSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $roles = new RoleSeeder();
        $color = new ColorSeeder();
        $race = new RaceSeeder();
        $tag = new TagSeeder();
        $translation = new TranslationSeeder();
        $wilaya = new WilayaSeeder();
        $offerType = new OfferTypeSeeder();

        $roles->run();
        $color->run();
        $race->run();
        $tag->run();
        $translation->run();
        $wilaya->run();
        $offerType->run();
        
    }
}
