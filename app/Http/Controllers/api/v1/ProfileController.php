<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Save;
use App\Models\Wilaya;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProfileController extends Controller
{
    public function showMyProfile(): JsonResponse
    {
        $user = Auth::user();
        $data['user'] = [
            'name' => $user->name,
            'email' => $user->email,
            'location' => $user->location,
            'wilaya_name' => $user->wilaya_name,
            'phone_number' => $user->phone_number,
            //'pic' => $user->pic ? apiUrl() . 'storage/users/' . $user->pic : null,
            'pic' => $user->pic ? $user->pic : null,
            'social_list' => $user->socials,
        ];

        $data['pets'] = [];

        foreach ($user->pets()->latest()->get() as $index => $pet) {
            //$image = $pet->getImages()->exists() ? apiUrl() . 'storage/pets/' . $pet->getImages[0]->image_url : null;
            $data['pets'][$index] = [
                'id' => $pet->id,
                'name' => $pet->name,
                'location' => $pet->location,
                'wilaya_name' => $pet->wilaya_name,
                'wilaya_number' => $pet->wilaya_number,

                'race_id' => $pet->race_id,
                'race_name' => $pet->race->name,

                'sub_race' => $pet->sub_race,
                'gender_id' => $pet->gender_id,

                'offer_type_id' => $pet->offer_type_id,
                'price' => $pet->price,

                'birthday' => $pet->birthday,
                'image_preview' => $pet->getImages[0]->image_url,
                'description' => Str::limit($pet->description, 25, '...'),
                'is_active' => $pet->is_active,
            ];
        }

        return response()->json([
            'message' => 'here data needed for screen',
            'user' => $data['user'],
            'pets' => $data['pets'],
        ]);
    }

    public function getMyProfileForEdit(): JsonResponse
    {
        $user = Auth::user();
        $data['user'] = [
            'name' => $user->name,
            'location' => $user->location,
            'wilaya_name' => $user->wilaya_name,
            'wilaya_number' => $user->wilaya_number,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            //'pic' => $user->pic ? apiUrl() . 'storage/users/' . $user->pic : null,
            'pic' => $user->pic ? $user->pic : null,
            'social_list' => $user->social_list,
        ];
        $wilayas = getAllWilaya();

        return response()->json([
            'message' => 'here data needed for screen',
            'user' => $data['user'],
            'wilayas' => $wilayas,
        ]);
    }

    public function updateMyProfile(Request $request): JsonResponse
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->location = $request->location;
        $user->wilaya_name = getWilayaName($request->wilaya_number);
        $user->wilaya_number = $request->wilaya_number;
        $user->phone_number = $request->phoneNumber;
        $user->social_list = $request->social_list;

        if (strlen($request->imageUpload) > 0) {
            //$data = base64_decode($request->imageUpload);
            $filename = 'user_' . $user->id .
                '_email_' . explode('@', $user->email)[0] .
                uniqid() .
                '.jpg';
            //Storage::put('public/users/' . $filename, $data);
            $result = Cloudinary::upload('data:image/png;base64,' . $request->imageUpload, [
                'public_id' => $filename
            ]);
            $user->pic = $result->getSecurePath();
        }
        $user->save();

        return response()->json([
            'message' => 'profile updated successfully',
            'user' => $user
        ], 200);
    }

    public function getSavedList(): JsonResponse
    {
        $saved = Auth::user()->save;
        return response()->json(1, 200);
    }
}
