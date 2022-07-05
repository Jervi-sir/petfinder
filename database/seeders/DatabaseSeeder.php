<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\TagSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\RaceSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\ColorSeeder;
use Database\Seeders\OfferType;
use Database\Seeders\WilayaSeeder;
use Database\Seeders\SubraceSeeder;
use Database\Seeders\UsertypeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's 0database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $tag = new TagSeeder();
        $role = new RoleSeeder();
        $race = new RaceSeeder();
        $colors = new ColorSeeder();
        $wilayas = new WilayaSeeder();
        $offer_type = new OfferTypeSeeder();

        $role->run();
        $race->run();
        $tag->run();
        $colors->run();
        $wilayas->run();
        $offer_type->run();
    }
}
