<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Pet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class PetController extends Controller
{
    public function all() :JsonResponse
    {
        return response()->json('', 201);
    }

    public function latest() :JsonResponse
    {
        return response()->json('', 201);
    }

    public function showByRace($race) :JsonResponse
    {
        return response()->json('', 201);
    }

    /* output:  id, name, user_id, location, wilaya_id, gender_id, 
                date, offer_type_id, price, race_name, sub_race
                images
    */
    public function showPet($id) :JsonResponse
    {
        $pet = Pet::find($id);
        $images = [];
        if($pet->getImages()->exists()) {
            foreach($pet->getImages as $image) {
                array_push($images, $image);
            }
        }
        $image = $pet->getImages()->exists() ? 'http://192.168.1.106:8000/storage/pets/' . $pet->getImages[0]->image_url : null;
        $data['pet'] = [
            'id' => $pet->id,
            'name' => $pet->name,
            'race_name' => $pet->race_name,
            'sub_race' => $pet->sub_race,
            'location' => $pet->location,
            'offer_type_id' => $pet->offer_type_id,
            'price' => $pet->price,
            'gender' => $pet->gender,
            'date' => str_replace('-', '/', $pet->birthday),
            'pic' => $images,
            'is_active' => $pet->isActive,
            'last_date_activated' => $pet->last_date_activated,
        ];
        return response()->json([
            'pet' => $data['pet'],
        ], 201);

    }

    public function latestByRace($filter) :JsonResponse
    {
        return response()->json('', 201);
    }
}
