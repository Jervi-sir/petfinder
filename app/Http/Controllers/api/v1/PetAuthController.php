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
   
    private function uploadImages($files, $user_id) {
        $uploadedFileUrl = [];
        foreach ($files as $image) {
            //$uploadedFileUrl[$i] = Cloudinary::upload($request->images[$i])->getSecurePath();
            $file = explode( ',', $image )[1];
            $filename= str_replace("-", "", Str::uuid()->toString()).'.png';
            Storage::disk('saveImages')->put($filename, base64_decode($file));
            array_push($uploadedFileUrl, $filename);
        }

    }

    public function getPostPet() :JsonResponse
    {
        $races = Race::all();
        foreach($races as $index => $race) {
            $data['races'][$index] = [
                'value' => $race->id,
                'label' => $race->name,
            ];
        }
        $wilayas = Wilaya::all();
        foreach($wilayas as $index => $wilaya) {
            $data['wilayas'][$index] = [
                'value' => $wilaya->id,
                'label' => $wilaya->name,
            ];
        }

        $user = Auth::user();
        return response()->json([
            'races' => $data['races'],
            'wilaya' => $data['wilayas'],
            'phone_number' => $user->phone_number,
        ]);
    }

    public function postPet(Request $request) :JsonResponse
    {
        try {
            $user = Auth::user();
            $uuid = uniqid();

            $last_date_activated = Carbon::now();
            $keywords = 0;

            $pet = new Pet();
            $pet->uuid = $uuid;
            $pet->name = $request->name;
            $pet->location = $request->location;
            $pet->wilaya_name = Wilaya::find($request->wilaya_id)->name;
            $pet->price = $request->price;
            $pet->weight = $request->weight;
            $pet->race_name = Race::find($request->race_id)->name;
            $pet->sub_race = $request->subRace;
            $pet->gender = $request->gender;
            $pet->color = $request->color;
            $pet->birthday = $request->date;
            $pet->description = $request->description;
            $pet->phone_number = $request->phoneNumber;
            $pet->last_date_activated = $last_date_activated;
            
            $pet->user_id = $user->id;
            $pet->race_id = $request->race_id;
            $pet->offer_type_id = $request->typeOffer;
            $pet->wilaya_id = $request->wilaya_id;

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
                    Storage::put('pets/' . $filename, $data);
                    
                    $img_save = new PetImage();
                    $img_save->pet_id = $pet->id;
                    $img_save->image_name = $pet->keywords;
                    $img_save->image_url = $filename;
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
            'race' => $pet->race,
            'gender' => $pet->gender,
            'colorName' => $pet->color,
            'birthday' => $pet->birthday,
            'description' => $pet->description,
            'phone_number' => $pet->phone_number,
            'race_id' => $pet->race_id,
            'offer_type_id' => $pet->offer_type_id,
            'wilaya_id' => $pet->wilaya_id,
        ];
        return response()->json($data['pet'], 200);
    }

    public function updatePet(Request $request, $petId) :JsonResponse
    {
        $pet = Pet::find($petId);
        $pet->name =  $request->name;
        $pet->location =  $request->location;
        $pet->race =  $request->race;
        $pet->gender =  $request->gender;
        $pet->colorName =  $request->color;
        $pet->birthday =  $request->birthday;
        $pet->description =  $request->description;
        $pet->phone_number =  $request->phone_number;
        $pet->race_id =  $request->race_id;
        $pet->offer_type_id =  $request->offer_type_id;
        $pet->wilaya_id =  $request->wilaya_id;
        $pet->wilaya =  Wilaya::find($request->wilaya_id)->name;
        $pet->save();

        return response()->json('', 200);
    }

    public function deleteWithoutBackupPet($petId) :JsonResponse
    {  
        Pet::destroy($petId);

        return response()->json('', 200);
    }
    
}
