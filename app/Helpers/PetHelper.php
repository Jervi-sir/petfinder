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
        'keywords' => $pet->keywords,
        'updated_at' => $pet->updated_at,
        'created_at' => $pet->created_at,
    ];
}
function getLostPetPreview($pet)
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
        'keywords' => $pet->keywords,
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

    /*
    These if the polymorphic relationship was setted up
    $lostPetPost = optional($pet->lostPetPost)->only([
        'is_active', 'last_date_activated',
    ]);
    if ($lostPetPost) {
        $lostPetPost['last_date_activated'] =  Carbon::parse($lostPetPost['last_date_activated'])->format('F j, Y g:i A');;
    }
    $adoptionSalePost = optional($pet->adoptionSalePost)->only([
        'price', 'adoption_status',
    ]);
    */

    return [
        'id' => $pet->id,
        'uuid' => $pet->uuid,
        'user' =>Auth::user(),
        'race_id' => $pet->race_id,
        'race_name' => $pet->race->name,
        'sub_race' => $pet->sub_race,       //verify why its being a string
        'gender_id' => $pet->gender_id,
        'gender_name' => $pet->gender->id,
        'offer_type_id' => $pet->offer_type_id,
        'offer_type_name' => $pet->offerType->id,
        'price' => $pet->price,
        'name' => $pet->name,
        'location' => $pet->location,
        'wilaya_id' => $pet->wilaya_id,
        'wilaya_name' => $pet->wilaya->name,
        'wilaya_number' => $pet->wilaya->number,
        'images' => $images ? $images : null,
        'birthday' => $pet->birthday,
        'color' => $pet->color,
        'weight' => $pet->weight,
        'description' => $pet->description,
        'phone_number' => $pet->phone_number,
        'is_vaccinated' => $pet->is_vaccinated,
        'special_needs' => $pet->special_needs,
        'keywords' => $pet->keywords,
        'created_at' => $pet->created_at,
        'updated_at' => $pet->updated_at,
        'adoption_status' => $pet->adoption_status,
        'last_date_activated' => $pet->last_date_activated,
        'is_active' => $pet->is_active,

        //'lostPetPost' => $lostPetPost,
        //'adoptionSalePost' => $adoptionSalePost,
    ];
}


function getLostPetDetailed($pet)
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

    /*
    These if the polymorphic relationship was setted up
    $lostPetPost = optional($pet->lostPetPost)->only([
        'is_active', 'last_date_activated',
    ]);
    if ($lostPetPost) {
        $lostPetPost['last_date_activated'] =  Carbon::parse($lostPetPost['last_date_activated'])->format('F j, Y g:i A');;
    }
    $adoptionSalePost = optional($pet->adoptionSalePost)->only([
        'price', 'adoption_status',
    ]);
    */

    return [
        'id' => $pet->id,
        'uuid' => $pet->uuid,
        'user' =>Auth::user(),
        'race_id' => $pet->race_id,
        'race_name' => $pet->race->name,
        'sub_race' => $pet->sub_race,       //verify why its being a string
        'gender_id' => $pet->gender_id,
        'gender_name' => $pet->gender->id,
        'price' => $pet->price,
        'name' => $pet->name,
        'location' => $pet->location,
        'wilaya_id' => $pet->wilaya_id,
        'wilaya_name' => $pet->wilaya->name,
        'wilaya_number' => $pet->wilaya->number,
        'images' => $images ? $images : null,
        'birthday' => $pet->birthday,
        'color' => $pet->color,
        'weight' => $pet->weight,
        'description' => $pet->description,
        'phone_number' => $pet->phone_number,
        'is_vaccinated' => $pet->is_vaccinated,
        'special_needs' => $pet->special_needs,
        'keywords' => $pet->keywords,
        'created_at' => $pet->created_at,
        'updated_at' => $pet->updated_at,
        'adoption_status' => $pet->adoption_status,
        'last_date_activated' => $pet->last_date_activated,
        'is_active' => $pet->is_active,

        //'lostPetPost' => $lostPetPost,
        //'adoptionSalePost' => $adoptionSalePost,
    ];
}
