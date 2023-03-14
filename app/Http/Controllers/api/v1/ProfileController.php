<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Save;
use App\Models\Wilaya;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function showMyProfile() :JsonResponse
    {
        $user = Auth::user();
        $data['user'] = [
            'name' => $user->name,
            'email' => $user->email,
            'location' => $user->location,
            'phone_number' => $user->phone_number,
            'pic' => 'http://192.168.1.106:8000/storage/users/' . $user->pic,
            'socials' => $user->socials,
        ];

        foreach($user->getPets as $index => $pet) {
            $data['pets'][$index] = [
                'id' => $pet->id,
                'name' => $pet->name,
                'race_name' => $pet->race_name,
                'sub_race' => $pet->sub_race,
                'offer_type_id' => $pet->offer_type_id,
                'price' => $pet->price,
                'gender' => $pet->gender,
                'last_date_activated' => $pet->last_date_activated,
            ];
        }

        return response()->json([
            'user' => $data['user'],
            'pets' => $data['pets'],
        ]);
    }
    public function getMyProfileForEdit() :JsonResponse
    {
        $user = Auth::user();
        $data['user'] = [
            'name' => $user->name,
            'location' => $user->location,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'pic' => 'http://192.168.1.106:8000/storage/users/' . $user->pic,
            'socials' => $user->socials,
        ];
        $wilayas = Wilaya::all();
        foreach($wilayas as $index => $wilaya) {
            $data['wilayas'][$index] = [
                'value' => $wilaya->id,
                'label' => $wilaya->name,
            ];
        }

        return response()->json([
            'user' => $data['user'],
            'wilayas' => $data['wilayas'],
        ]);
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
    {   
        $user = Auth::user();
        $user->name = $request->name;
        $user->phone_number = $request->phoneNumber;
        $user->socials = $request->socials;
        $user->location = $request->location;

        if(strlen($request->imageUpload) > 0) {
            $data = base64_decode($request->imageUpload);
            $filename = 'user_' . $user->id . 
            '_email_' . explode('@', $user->email)[0] .
            uniqid() .
            '.jpg';
            Storage::put('public/users/' . $filename, $data);

            $user->pic = $filename;
        }
        $user->save();

        return response()->json('success', 200);
    }
    public function getSavedList() :JsonResponse
    {
        $saved = Auth::user()->save;
        return response()->json(1, 200);
    }

}
