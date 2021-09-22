<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubraceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_races')->insert([
            'race_id' => 1,
            'name' => 'sciamoi'
        ]);
        DB::table('sub_races')->insert([
            'race_id' => 1,
            'name' => 'noire'
        ]);
        DB::table('sub_races')->insert([
            'race_id' => 1,
            'name' => 'ecail de tortue'
        ]);
    }
}
