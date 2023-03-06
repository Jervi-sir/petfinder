<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('colors')->insert([
            'name' => 'black'
        ]);
        DB::table('colors')->insert([
            'name' => 'white'
        ]);
        DB::table('colors')->insert([
            'name' => 'brown'
        ]);
    }
}
