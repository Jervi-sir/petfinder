<?php

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;


    /**
     *  get Pets from object input.
     *
     *  @return \ data object
     */
    function getPets($pets) {
        $base_pet = URL::to('/pets') . '/';

        foreach ($pets as $key => $pet) {
            $data['pets'][$key] = [
                'url' => $base_pet . $pet->uuid,             //use uuid
                'name' => $pet->name,
                'gender' => $pet->gender,
                'race' => $pet->race->name,
                'subRace' => $pet->subRace->name,
                'status' => $pet->status->name,
                'wilaya' => $pet->wilaya->name,
                'status' => $pet->status->name,
                'age' => getAge($pet->date_birth),
                'image' => getFirstImage($pet->pics)
            ];
        }
        return (object)$data['pets'];
    }

    /**
     *  Calculate age.
     *
     *  @return \ string
     */
    function getAge($date_birth) {
        $created = new Carbon($date_birth);
        $now = Carbon::now();
        $difference = ($now->from($created));

        $difference = str_replace(" before","",$difference);
        return str_replace(" after","",$difference);
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
        if($total > 360) {
            $years = intval($total / 360);
            $total = $total - ($years * 360);
            $age = $years . 'y ';
        }
        if($total >= 30) {
            $leftMonths = intval($total % 30);
            $total = $total - ($leftMonths * 30);
            $age = $age . $leftMonths . 'm';
        }
        else {
            $leftDays = intval($total % 30);
            $total = $total - ($leftDays * 1);
            if(strpos($age, 'm') == false) {
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
        $uuid = $uuidFirst . '-' . $race. '-' . str_replace(" ", "", $name);
        return $uuid;
    }

    /**
     *  inject url in image name.
     *
     *  @return \ string
     */
    function imagesToUrl($images) {
        $base_image = URL::to('/clientImages') . '/';
        $pet_pics_with_url = [];
        $pet_pics = json_decode($images);
        foreach($pet_pics as $pic) {
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
    function getFirstImage($images) {
        if(empty(json_decode($images))) {
            return '';
        }
        return imagesToUrl($images)[0];
    }

