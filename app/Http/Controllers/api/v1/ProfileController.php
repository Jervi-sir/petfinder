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
            'wilaya_name' => $user->wilaya_name,
            'phone_number' => $user->phone_number,
            'pic' => $user->pic ? 'http://192.168.1.106:8000/storage/users/' . $user->pic : null,
            'social_list' => $user->socials,
        ];


        $data['pets'] = [];

        foreach($user->getPets as $index => $pet) {
            $image = $pet->getImages()->exists() ? 'http://192.168.1.106:8000/storage/pets/' . $pet->getImages[0]->image_url : null;
            $data['pets'][$index] = [
                'id' => $pet->id,
                'name' => $pet->name,
                'location' => $pet->location,
                'wilaya_name' => $pet->wilaya_name,
                'wilaya_number' => $pet->wilaya_number,

                'race_name' => $pet->race_name,
                'sub_race' => $pet->sub_race,
                'gender_id' => $pet->gender_id,
                'gender_name' => $pet->gender_name,

                'offer_type_id' => $pet->offer_type_id,
                'offer_type_name' => getOfferTypeName($pet->offer_type_id),
                'price' => $pet->price,

                'birthday' => $pet->birthday,
                'image_preview' => $image,

                'is_active' => $pet->is_active,
            ];
        }

        return response()->json([
            'message' => 'here data needed for screen',
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
            'wilaya_name' => $user->wilaya_name,
            'wilaya_number' => $user->wilaya_number,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'pic' => $user->pic ? 'http://192.168.1.106:8000/storage/users/' . $user->pic : null,
            'social_list' => $user->social_list,
        ];
        $wilayas = getAllWilaya();

        return response()->json([
            'message' => 'here data needed for screen',
            'user' => $data['user'],
            'wilayas' => $wilayas,
        ]);
    }

    public function updateMyProfile(Request $request) :JsonResponse
    {   
        $user = Auth::user();
        $user->name = $request->name;
        $user->location = $request->location;
        $user->wilaya_name = getWilayaName($request->wilaya_number);
        $user->wilaya_number = $request->wilaya_number;
        $user->phone_number = $request->phoneNumber;
        $user->social_list = $request->social_list;

        if(strlen($request->imageUpload) > 0) {
            $data = base64_decode($request->imageToServer);
            $filename = 'user_' . $user->id . 
            '_email_' . explode('@', $user->email)[0] .
            uniqid() .
            '.jpg';
            Storage::put('public/users/' . $filename, $data);
            $user->pic = $filename;
        }
        $user->save();

        return response()->json([
            'message' => 'profile updated successfully',
            'user' => $user
        ], 200);
    }

    public function getSavedList() :JsonResponse
    {
        $saved = Auth::user()->save;
        return response()->json(1, 200);
    }

}
