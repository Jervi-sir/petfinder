<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Pet;
use Cloudinary\Cloudinary;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\PetImage;
use App\Models\Race;
use App\Models\Wilaya;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class PetAuthController extends Controller
{
   
    public function getPostPet() :JsonResponse
    {
        $races = Race::all();
        foreach($races as $index => $race) {
            $data['races'][$index] = [
                'value' => $race->id,
                'label' => $race->name,
            ];
        }
        $wilayas = getAllWilaya();

        $user = Auth::user();
        return response()->json([
            'races' => $data['races'],
            'wilaya' => $wilayas,
            'phone_number' => $user->phone_number,
        ]);
    }

    public function postPet(Request $request) :JsonResponse
    {

        $validateUser = Validator::make($request->all(), 
        [
            'images' => 'required',
            'wilaya_id' => 'required',
            'race_id' => 'required',
        ]);

        if($validateUser->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }
            
        try {
            $user = Auth::user();
            $uuid = uniqid();

            $last_date_activated = Carbon::now();

            $pet = new Pet();
            $pet->uuid = $uuid;
            $pet->name = $request->name;
            $pet->location = $request->location;
            $pet->wilaya_name = getWilayaName($request->wilaya_id);
            $pet->wilaya_number = $request->wilaya_id;
            
            $pet->race_name = Race::find($request->race_id)->name;
            $pet->sub_race = $request->subRace;
            $pet->gender = $request->gender;

            $pet->offer_type_id = $request->typeOffer;
            $pet->price = $request->price;
            $pet->birthday = $request->date;
            $pet->color = $request->color;
            $pet->weight = $request->weight;
            $pet->description = $request->description;
            $pet->phone_number_this_pet = $request->phone_number;

            $pet->last_date_activated = $last_date_activated;
            
            $pet->user_id = $user->id;
            $pet->race_id = $request->race_id;

            $pet->keywords = generateKeywords($pet);
            
            $pet->save();

            foreach($request->images as $index => $image) {
                if($image != null) {

                    $data = base64_decode($image);
                    $filename = 'race_' . $request->race_id . 
                    '_user_' . $user->id .
                    '_random_' . $uuid .
                    '_i_' . $index .
                    '.jpg';
                    Storage::put('public/pets/' . $filename, $data);
                    
                    $img_save = new PetImage();
                    $img_save->pet_id = $pet->id;
                    $img_save->image_url = $filename;
                    $img_save->meta = $pet->keywords;
                    $img_save->save();
                }
            }
    
            return response()->json([
                'status' => true,
                'message' => 'Pet Created Successfully',
                'token' => $pet,
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }


        return response()->json('', 200);
    }

    public function editPet($petId) :JsonResponse
    {
        $pet = Pet::find($petId);
        $data['pet'] = [
            'name' => $pet->name,
            'location' => $pet->location,
            'wilaya_name' => $pet->wilaya_name,
            'wilaya_number' => $pet->wilaya_number,

            'race_name' => $pet->race_name,
            'sub_race' => $pet->sub_race,
            'gender' => $pet->gender,

            'offer_type_number' => $pet->offer_type_number,
            'price' => $pet->price,

            'birthday' => $pet->birthday,
            'color' => $pet->color,
            'weight' => $pet->weight,
            'description' => $pet->description,
            'phone_number' => $pet->phone_number_this_pet,
            'race_id' => $pet->race_id,
        ];
        return response()->json($data['pet'], 200);
    }

    public function updatePet(Request $request, $petId) :JsonResponse
    {
        $pet = Pet::find($petId);
        $pet->name =  $request->name;
        $pet->location =  $request->location;
        $pet->wilaya_name =  getWilayaName($request->wilaya_number);
        $pet->wilaya_number =  $request->wilaya_number;

        $pet->race_name =  Race::find($request->race)->name;
        $pet->sub_race =  $request->sub_race;
        $pet->gender =  $request->gender;

        $pet->offer_type_number =  $request->offer_type_id;
        $pet->price =  $request->price;

        $pet->birthday =  $request->birthday;

        $pet->color =  $request->color;
        $pet->weight =  $request->weight;
        $pet->description =  $request->description;
        $pet->phone_number_this_pet = $request->phone_number;
        $pet->race_id =  $request->race_id;
        $pet->keywords = generateKeywords($pet);

        $pet->save();

        return response()->json('', 200);
    }

    public function deleteWithoutBackupPet($petId) :JsonResponse
    {  
        Pet::destroy($petId);

        return response()->json('', 200);
    }
    
}
