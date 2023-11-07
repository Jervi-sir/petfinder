<?php

namespace Database\Seeders;

use App\Models\PetName;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use League\Csv\Reader;

class PetNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvPath = public_path('animal_names.csv');

        $csv = Reader::createFromPath($csvPath, 'r');

        // Set the CSV header offset if your CSV has a header row
        $csv->setHeaderOffset(0);

        // Get the records (each record is an associative array)
        $records = $csv->getRecords();

        foreach ($records as $offset => $record) {
            // $record is an associative array with keys as the CSV header column values
            // You can process each record here
            $sample = new PetName();
            $sample->name = $record['name'];
            $sample->race = $record['type'];
            $sample->subrace = $record['race'];
            $sample->gender = $record['sex'];
            $sample->colors = $record['color'];
            $sample->save();

        }

    }
}
