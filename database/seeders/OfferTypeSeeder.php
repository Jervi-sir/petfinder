<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OfferTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
