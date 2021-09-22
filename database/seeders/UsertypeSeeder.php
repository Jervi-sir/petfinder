<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsertypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usertypes')->insert([
            'name' => 'seller'
        ]);
        DB::table('usertypes')->insert([
            'name' => 'vet'
        ]);
    }
}
