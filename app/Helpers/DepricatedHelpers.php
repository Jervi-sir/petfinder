<?php

function apiUrl()
{
    return 'http://192.168.1.107:8000/';
}

function storedWilaya()
{
    return [
        ['id' => 1,  'name' => 'Adrar', 'code' => 'adrar'],
        ['id' => 16, 'name' => 'Alger', 'code' => 'alger'],
        ['id' => 17, 'name' => 'Djelfa', 'code' => 'djelfa'],
        ['id' => 13, 'name' => 'Tlemcen', 'code' => 'tlemcen'],
        ['id' => 31, 'name' => 'Oran', 'code' => 'oran'],
        ['id' => 46, 'name' => 'Ain Temouchent', 'code' => 'ain temouchent'],
        ['id' => 47, 'name' => 'Ghardaia', 'code' => 'ghardaia'],
    ];
}

function storedOfferType()
{
    return [
        1 => ['id' => 1, 'name' => 'adoption'],
        2 => ['id' => 2, 'name' => 'sale'],
        3 => ['id' => 3, 'name' => 'rent'],
    ];
}

function storedGender()
{
    return [
        1 => ['id' => 1, 'name' => 'male'],
        2 => ['id' => 2, 'name' => 'female'],
        3 => ['id' => 3, 'name' => 'unkown'],
    ];
}

function getAllWilaya()
{
    return storedWilaya();
}

function getAllOfferType()
{
    return storedOfferType();
}

function getAllGenders()
{
    return storedGender();
}

function translateToEnglish($sentence)
{
    $eng_keywords = [];
    $keywords = explode(" ", preg_replace("/[^A-Za-z0-9 ]\s+/", ' ', $sentence));

    foreach ($keywords as $key => $keyword) {
        $tmp = Translation::where('translation', 'like', '%' . $keyword . '%')->first();
        //if eng_word is null
        if ($tmp == null) {
            continue;
        }
        $eng_keyword = $tmp->english_word;
        $score = $tmp->score;

        $array[] = array('score' => $score, 'keyword' => $eng_keyword);
    }

    $columns = array_column($array, 'score');
    array_multisort($columns, SORT_ASC, $array);

    return $array;
}
