<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('translations')->insert([
            'score' => 1,
            'english_word' => 'cat',
            'translation' => 'cat chat قط chatton kitten kitty',
        ]);
        DB::table('translations')->insert([
            'score' => 1,
            'english_word' => 'dog',
            'translation' => 'dog chien كلب pet doggy petty',
        ]);
        DB::table('translations')->insert([
            'score' => 5,
            'english_word' => 'black',
            'translation' => 'black dark noir noire اسود اكحل كحل',
        ]);
        DB::table('translations')->insert([
            'score' => 5,
            'english_word' => 'black',
            'translation' => 'black dark noir noire اسود اكحل كحل',
        ]);
        DB::table('translations')->insert([
            'score' => 3,
            'english_word' => 'siamoa',
            'translation' => 'siamoa siamo سيامو سياموا',
        ]);
    }
}
