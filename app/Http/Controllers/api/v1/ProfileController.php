<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Save;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showMyProfile() :JsonResponse
    {
        $user = Auth::user();
        $data['user'] = [
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'pic' => $user->pic,
            'socials' => $user->socials,
        ];
        return response()->json($data['user'], 200);
    }
    public function getMyProfileForEdit() :JsonResponse
    {
        $user = Auth::user();
        $data['user'] = [
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'pic' => $user->pic,
            'socials' => $user->socials,
        ];
        return response()->json($data['user'], 200);
    }
    public function listMyPets() :JsonResponse
    {
        $pets = Auth::user()->pets;
        foreach($pets as $key=>$pet) {
            $data['pet'][$key] = [
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
        }
        
        return response()->json($data['pet'], 200);
    }
    public function updateMyProfile(Request $request) :JsonResponse
    {   $user = Auth::user();
        $user->phone_number = $request->phone_number;
        $user->pic = $request->pic;
        $user->socials = $request->socials;
        $user->save();

        return response()->json('', 200);
    }
    public function getSavedList() :JsonResponse
    {
        $saved = Auth::user()->save
        return response()->json('', 200);
    }

}
