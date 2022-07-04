<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('races')->insert([
            'order' => 1,
            'name' => 'cat'
        ]);
        DB::table('races')->insert([
            'order' => 2,
            'name' => 'dog'
        ]);
        DB::table('races')->insert([
            'order' => 3,
            'name' => 'horse'
        ]);
        DB::table('races')->insert([
            'order' => 4,
            'name' => 'bird'
        ]);
        DB::table('races')->insert([
            'order' => 5,
            'name' => 'hamster'
        ]);
        DB::table('races')->insert([
            'order' => 6,
            'name' => 'bird'
        ]);
        DB::table('races')->insert([
            'order' => 6,
            'name' => 'fish'
        ]);
        DB::table('races')->insert([
            'order' => 6,
            'name' => 'goat'
        ]);
    }
}
