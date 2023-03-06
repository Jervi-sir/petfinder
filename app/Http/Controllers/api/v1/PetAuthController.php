<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Pet;
use Cloudinary\Cloudinary;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
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
    public function postPet(Request $request) :JsonResponse
    {
        try {
            //Validated
            $validateUser = Validator::make($request->all(), 
            [
                'name' => 'required',
                'wilaya' => 'required',
                'race' => 'required',
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $uuid = uniqueUuid($request->race ,$request->name);
            $location = 0;
            $last_date_activated = Carbon::now();
            $keywords = 0;
            $pics = 0;

            $pet = Pet::create([
                'name' => $request->name,
                'email' => $request->email,
                'uuid' => $uuid,
                'name' => $request->name,
                'location' => $location,
                'race' => $request->race,
                'gender' => $request->gender,
                'colorName' => $request->color,
                'birth_date' => $request->birthday,
                'birthday' => $request->birthday,
                'description' => $request->description,
                'phone_number' => $request->phone_number,

                'last_date_activated' => $last_date_activated,
                'keywords' => $keywords,

                'user_id' => Auth::user()->id,
                'race_id' => $request->race_id,
                'offer_type_id' => $request->offer_type_id,
                'wilaya_id' => $request->wilaya_id,
            ]);

            /*
            
            */

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
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
        $pet->save();

        return response()->json('', 200);
    }

    public function deleteWithoutBackupPet($petId) :JsonResponse
    {  
        Pet::destroy($petId);

        return response()->json('', 200);
    }
    
}
