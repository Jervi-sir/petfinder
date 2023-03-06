<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PetAuthController extends Controller
{
    public function postPet(Request $request) :JsonResponse
    {
        $uuid = uniqueUuid($request->race ,$request->name);

        $uploadedFileUrl = [];
        foreach ($request->imageCompressed as $image) {
            //$uploadedFileUrl[$i] = Cloudinary::upload($request->imageCompressed[$i])->getSecurePath();
            $file = explode( ',', $image )[1];
            $filename= str_replace("-", "", Str::uuid()->toString()).'.png';
            Storage::disk('saveImages')->put($filename, base64_decode($file));
            array_push($uploadedFileUrl, $filename);
        }
        
        $location = 0;
        $last_date_activated = 0;
        $keywords = 0;
        $pics = 0;

        $pet = new Pet();
        $pet->uuid = $uuid;
        $pet->name = $request->name;
        $pet->location = $location;
        $pet->raceName = $request->race;
        $pet->gender = $request->gender;
        $pet->colorName = $request->color;
        $pet->birth_date = $request->birth_date;
        $pet->birthday = $request->birthday;
        $pet->description = $request->description;
        $pet->phone_number = $request->phone_number;

        $pet->last_date_activated = $last_date_activated;
        $pet->keywords = $keywords;
        $pet->pics = $pics;

        $pet->user_id = Auth::user()->id;
        $pet->race_id = $request->race_id;
        $pet->offer_type_id = $request->offer_type_id;
        $pet->wilaya_id = $request->wilaya_id;


        return response()->json('', 200);
    }

    public function editPet($petId) :JsonResponse
    {
        return response()->json('', 200);
    }

    public function storePet() :JsonResponse
    {
        return response()->json('', 200);
    }

    public function updatePet() :JsonResponse
    {
        return response()->json('', 200);
    }

    public function deleteWithoutBackupPet($petId) :JsonResponse
    {
        return response()->json('', 200);
    }
    
}
