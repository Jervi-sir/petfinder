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
            'name' => 'cat'
        ]);
        DB::table('races')->insert([
            'name' => 'dog'
        ]);
        DB::table('races')->insert([
            'name' => 'horse'
        ]);
        DB::table('races')->insert([
            'name' => 'horse'
        ]);
        DB::table('races')->insert([
            'name' => 'bird'
        ]);
    }
}
