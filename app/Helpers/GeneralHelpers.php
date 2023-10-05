<?php

use App\Models\Race;
use App\Models\Wilaya;
use App\Models\SubRace;

function getAllWilaya() {
    $wilayas = Wilaya::all();
    foreach ($wilayas as $index => $wilaya) {
        $data['wialaya'][$index] = [
            'value' => $wilaya['id'],
            'label' => $wilaya['name'],
        ];
    }
}

function getAllRaces() {
    $races = Race::all();
    $data['races'] = [];
    foreach ($races as $index => $race) {
        $data['races'][$index] = [
            'id' => $race->id,
            'name' => $race->name,
            //'details' => $race->details,
            'sub_races' => getSubRaces($race->id),
        ];
    }
    return $data['races'];
}

function getSubRaces($race_id) {
    $sub_races = SubRace::where('race_id', $race_id)->get();
    $data['sub_races'] = [];
    foreach ($sub_races as $index => $sub_race) {
        $data['sub_races'][$index] = [
            'id' => $sub_race->id,
            'race_id' => $sub_race->race_id,
            'name' => $sub_race->name,
            //'details' => $sub_race->details,
        ];
    }
    return $data['sub_races'];
}

function getAllWilayas() {
    $wilayas = Wilaya::all();
    $data['wilayas'] = [];
    foreach ($wilayas as $index => $wilaya) {
        $data['wilayas'][$index] = [
            'id' => $wilaya->id,
            'name' => $wilaya->name,
            'number' => $wilaya->number,
        ];
    }
    return $data['wilayas'];
}

function getWilayaName($number)
{
    $wilaya = Wilaya::where('number', $number)->first();
    return $wilaya->name;
}


function getWilayaId($number)
{
    $wilaya = Wilaya::where('number', $number)->first();
    return $wilaya->id;
}


function getOfferTypeName($number)
{
    foreach (storedOfferType() as $element) {
        if ($element['id'] == $number) {
            return $element['name'];
        }
    }
    return null;
}


function getGenderName($number)
{
    foreach (storedGender() as $element) {
        if ($element['id'] == $number) {
            return $element['name'];
        }
    }
    return null;
}

function getAge($date_birth)
{
    $created = new Carbon($date_birth);
    $now = Carbon::now();
    $difference = ($now->from($created));

    $difference = str_replace(" before", "", $difference);
    return str_replace(" after", "", $difference);
}

function getAgeV1($date_birth)
{
    $now = time(); // or your date as well
    $your_date = strtotime($date_birth);
    $datediff = $now - $your_date;
    $total = $datediff / (60 * 60 * 24);
    $age = '';
    if ($total > 360) {
        $years = intval($total / 360);
        $total = $total - ($years * 360);
        $age = $years . 'y ';
    }
    if ($total >= 30) {
        $leftMonths = intval($total % 30);
        $total = $total - ($leftMonths * 30);
        $age = $age . $leftMonths . 'm';
    } else {
        $leftDays = intval($total % 30);
        $total = $total - ($leftDays * 1);
        if (strpos($age, 'm') == false) {
            $age = $age . $leftDays . 'd';
        }
    }

    return $age;
}

function uniqueUuid($race, $name)
{
    $uuidString = (string) Str::uuid();
    $uuidFirst = substr($uuidString, 0, 5);
    $uuid = $uuidFirst . '_' . $race . '_' . str_replace(" ", "", $name);
    return $uuid;
}

function imagesToUrl($images)
{
    $base_image = URL::to('/getImages') . '/';
    $pet_pics_with_url = [];
    $pet_pics = json_decode($images);
    foreach ($pet_pics as $pic) {
        $url = $base_image . $pic;
        array_push($pet_pics_with_url, $url);
    }
    return $pet_pics_with_url;
}

function getFirstImage($images)
{
    if (empty(json_decode($images))) {
        return '';
    }
    return imagesToUrl($images)[0];
}

function generateKeywords($pet)
{
    $name = $pet->name;
    $location = $pet->location;
    $wilaya_id = $pet->wilaya_id;
    $wilaya_name = $pet->wilaya_name;
    $weight = $pet->weight;
    $race_name = Race::find($pet->race_id)->name;
    $sub_race = $pet->sub_race;
    $gender = ['male', 'female', 'unknown'][$pet->gender + 1];
    $color = $pet->color;
    $offerType = ['adopt', 'sell', 'rent'][$pet->gender + 1];

    $keywords =
        $name . ' , ' .
        $location . ' , ' .
        $wilaya_id . ' , ' .
        $wilaya_name . ' , ' .
        $weight . ' , ' .
        $race_name . ' , ' .
        $sub_race . ' , ' .
        $gender . ' , ' .
        $color . ' , ' .
        $offerType . ' , ';

    return $keywords;
}