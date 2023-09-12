<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubRacesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subRaces = [
            [
                'race_id' => 1, // Assuming 2 corresponds to Cat
                'sub_races' => ['Siamese', 'Persian', 'Maine Coon']
            ],
            [
                'race_id' => 2, // Assuming 1 corresponds to Dog
                'sub_races' => ['Labrador', 'Golden Retriever', 'Bulldog']
            ]
            // Add more here...
        ];

        foreach ($subRaces as $race) {
            $raceId = $race['race_id'];
            foreach ($race['sub_races'] as $subRace) {
                DB::table('sub_races')->insert([
                    'race_id' => $raceId,
                    'name' => $subRace,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }


    }
}
