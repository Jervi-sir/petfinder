<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $races = [
            'Cat',
            'Dog',
            'Bird',
            'Horse',
            'Hamster',
            'Fish',
            'Goat',
            'Reptile',
            'Rodent',
            'Other'
        ];

        foreach ($races as $race) {
            DB::table('races')->insert([
                'name' => $race,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
