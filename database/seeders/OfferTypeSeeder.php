<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OfferTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('offer_types')->insert([
            'name' => 'adoption'
        ]);
        DB::table('offer_types')->insert([
            'name' => 'sell'
        ]);
        DB::table('offer_types')->insert([
            'name' => 'rent'
        ]);
    }
}
