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


function getPetPreview($pet)
{
    $is_liked = null;
    if (Auth::user()) {
        $is_liked = Auth::user()->savedPets()->where('pet_id', $pet->id)->exists() ? true : false;
    }
    //$image = $pet->getImages()->exists() ? apiUrl() . 'storage/pets/' . $pet->getImages[0]->image_url : null;
    return [
        'id' => $pet->id,
        'uuid' => $pet->uuid,

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
        //'image_preview' => $pet->getImages[0]->image_url ?? null,
        'image_preview' => json_decode($pet->images)[0],

        'birthday' => $pet->birthday,
        'color' => $pet->color,
        'weight' => $pet->weight,
        'is_liked' => $is_liked,

        
        //'description' => $pet->description,
        //'phone_number' => $pet->phone_number,
        'keywords' => $pet->keywords,
        //'is_active' => $pet->is_active,
        //'last_date_activated' => $pet->last_date_activated,
    ];
}

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

