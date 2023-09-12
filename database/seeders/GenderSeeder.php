<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genders')->insert([
            'id' => 1,
            'name' => 'male',
        ]);
        DB::table('genders')->insert([
            'id' => 2,
            'name' => 'female',
        ]);
        DB::table('genders')->insert([
            'id' => 3,
            'name' => 'unknown',
        ]);
    }
}
