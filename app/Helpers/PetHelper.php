<?php

use App\Models\Gender;
use Carbon\Carbon;
use App\Models\Race;
use App\Models\Wilaya;
use App\Models\Petbackup;
use App\Models\Translation;
use Illuminate\Support\Str;
use App\Models\ImagesToDelete;
use App\Models\OfferType;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

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

function getWilayaName($number)
{
    $wilaya = Wilaya::where('number', $number)->first();
    return $wilaya->name;
    /*
    foreach (getAllWilaya() as $element) {
        if ($element['id'] == $number) {
            return $element['name'];
        }
    }
    return null;
    */
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

/**
 *  get Pet from object input.
 *
 *  @return \ data object
 */
function getPetDetailed($pet)
{
    $is_liked = false;
    if (Auth::user()) {
        $is_liked = Auth::user()->savedPets()->where('pet_id', $pet->id)->exists() ? true : false;
    }

    $images = [];
    if ($pet->images) {
        foreach (json_decode($pet->images) as $image) {
            array_push($images, [
                'desc' => '$image->meta',
                'image' => $image,
            ]);
        }
    }

    return [
        'user' =>Auth::user(),
        'id' => $pet->id,
        //'uuid' => $pet->uuid,
        'name' => $pet->name,
        'location' => $pet->location,
        'wilaya_name' => $pet->wilaya_name,
        'wilaya_number' => $pet->wilaya_number,

        'race_name' => $pet->race_name,
        'sub_race' => $pet->sub_race,
        'gender_id' => $pet->gender_id,
        'gender_name' => $pet->gender_name,

        'offer_type_id' => $pet->offer_type_id,
        'offer_type_name' => $pet->offer_type_name,
        'price' => $pet->price,

        'birthday' => $pet->birthday,

        'color' => $pet->color,
        'weight' => $pet->weight,
        'description' => $pet->description,
        'phoneNumber' => $pet->phone_number,

        'images' => $images ? $images : null,
        'is_active' => $pet->is_active,
        'is_liked' => $is_liked,
    ];
}

function getPetPreview($pet)
{
    $is_liked = null;
    if (Auth::user()) {
        $is_liked = Auth::user()->savedPets()->where('pet_id', $pet->id)->exists() ? true : false;
    }
    //$image = $pet->getImages()->exists() ? apiUrl() . 'storage/pets/' . $pet->getImages[0]->image_url : null;
    return [
        'id' => $pet->id,
        //'uuid' => $pet->uuid,

        'race_id' => $pet->race_id,
        'race_name' => Race::find($pet->race_id)->name,
        'sub_race' => $pet->sub_race,

        'gender_id' => $pet->gender_id,
        'gender_name' => Gender::find($pet->gender_id)->name,

        'offer_type_id' => $pet->offer_type_id,
        'offer_type_name' => OfferType::find($pet->offer_type_id)->name,
        'price' => $pet->price,

        'name' => $pet->name,

        'location' => $pet->location,
        'wilaya_id' => $pet->wilaya_id,
        'wilaya_name' => $pet->wilaya_id,

        'birthday' => $pet->birthday,
        'color' => $pet->color,
        'weight' => $pet->weight,

        //'image_preview' => $pet->getImages[0]->image_url ?? null,
        'image_preview' => json_decode($pet->images)[0],
        'is_liked' => $is_liked,
        //'description' => $pet->description,
        //'phone_number' => $pet->phone_number,
        //'keywords' => $pet->keywords,
        //'is_active' => $pet->is_active,
        //'last_date_activated' => $pet->last_date_activated,
    ];
}

/**
 *  Calculate age.
 *
 *  @return \ string
 */
function getAge($date_birth)
{
    $created = new Carbon($date_birth);
    $now = Carbon::now();
    $difference = ($now->from($created));

    $difference = str_replace(" before", "", $difference);
    return str_replace(" after", "", $difference);
}

/**
 *  Calculate age but old version.
 *
 *  @return \ string
 */
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

/**
 *  get Unique uuid.
 *
 *  @return \ string with uuid, race. name
 */
function uniqueUuid($race, $name)
{
    $uuidString = (string) Str::uuid();
    $uuidFirst = substr($uuidString, 0, 5);
    $uuid = $uuidFirst . '_' . $race . '_' . str_replace(" ", "", $name);
    return $uuid;
}

/**
 *  inject url in image name.
 *
 *  @return \ string
 */
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

/**
 *  get first image url.
 *
 *  @return \ string
 */
function getFirstImage($images)
{
    if (empty(json_decode($images))) {
        return '';
    }
    return imagesToUrl($images)[0];
}

function profileImageUrl($image)
{
    $base_image = URL::to('/profileImages') . '/';
    return $base_image . $image;
}

/**
 * input string
 * output array of keyword sorted by score
 * turn keywords single line string into a keyword array
 * ignore what doesnt exist in db
 */
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


/**
 * input request
 * output keywords
 */

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
