<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WilayaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
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
