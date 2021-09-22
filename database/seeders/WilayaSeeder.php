<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WilayaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wilayas')->insert([
            'number' => 31,
            'name' => 'oran'
        ]);
        DB::table('wilayas')->insert([
            'number' => 46,
            'name' => 'ain temouchent'
        ]);
        DB::table('wilayas')->insert([
            'number' => 16,
            'name' => 'Alger'
        ]);
    }
}
