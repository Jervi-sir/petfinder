<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tags')->insert([
            'name' => 'cat'
        ]);
        DB::table('tags')->insert([
            'name' => 'dog'
        ]);
        DB::table('tags')->insert([
            'name' => 'horse'
        ]);
        DB::table('tags')->insert([
            'name' => 'fish'
        ]);
        DB::table('tags')->insert([
            'name' => 'snake'
        ]);
    }
}
