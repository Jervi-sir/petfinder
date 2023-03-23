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
        DB::table('wilayas')->insert(['id' => 1,  'name' => 'Adrar', 'number' => 1]);
        DB::table('wilayas')->insert(['id' => 16, 'name' => 'Alger', 'number' => 16]);
        DB::table('wilayas')->insert(['id' => 17, 'name' => 'Djelfa', 'number' => 17]);
        DB::table('wilayas')->insert(['id' => 13, 'name' => 'Tlemcen', 'number' => 13]);
        DB::table('wilayas')->insert(['id' => 31, 'name' => 'Oran', 'number' => 31]);
        DB::table('wilayas')->insert(['id' => 46, 'name' => 'Ain Temouchent', 'number' => 46]);
        DB::table('wilayas')->insert(['id' => 47, 'name' => 'Ghardaia', 'number' => 47]);
    }
}
