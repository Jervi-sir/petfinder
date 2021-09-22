<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\TagSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\RaceSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\StatusSeeder;
use Database\Seeders\SubraceSeeder;
use Database\Seeders\UsertypeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $role = new RoleSeeder();
        $race = new RaceSeeder();
        $subRace = new SubraceSeeder();
        $status = new StatusSeeder();
        $tag = new TagSeeder();
        $userType = new UsertypeSeeder();

        $role->run();
        $race->run();
        $subRace->run();
        $status->run();
        $tag->run();
        $userType->run();
    }
}
