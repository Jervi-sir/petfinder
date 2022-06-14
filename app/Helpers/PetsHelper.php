<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;


    function getAge($date_birth)
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

    function uniqueUuid($race, $name)
    {
        $uuidString = (string) Str::uuid();
        $uuidFirst = substr($uuidString, 0, 5);
        $uuid = $uuidFirst . '-' . $race. '-' . str_replace(" ", "", $name);
        return $uuid;
    }

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

    function getFirstImage($images) {
        if(empty(json_decode($images))) {
            return '';
        }
        return imagesToUrl($images)[0];
    }
