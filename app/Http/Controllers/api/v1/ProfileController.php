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
    public $pagination_amount = 8;

    public function showMyProfile(): JsonResponse
    {
        $user = Auth::user();
        $data['user'] = getProfileData($user);

        $data['pets'] = [];

        foreach ($user->pets()->latest()->get() as $index => $pet) {
            //$image = $pet->getImages()->exists() ? apiUrl() . 'storage/pets/' . $pet->getImages[0]->image_url : null;
            $data['pets'][$index] = getPetPreview($pet);
        }

        return response()->json([
            'message' => 'here data needed for screen',
            'user' => $data['user'],
            'pets' => $data['pets'],
        ]);
    }
    public function getMyPets(Request $request) :JsonResponse
    {
        $user = Auth::user();

        $query = $user->pets();
        if ($request->has('race_id')) {
            $query->where('race_id', $request->input('race_id'));
        }
        if ($request->has('sub_race')) {
            $query->where('sub_race', 'like', '%' . $request->input('sub_race') . '%');
        }
        if ($request->has('offer_type_id')) {
            $query->where('offer_type_id', 'like', '%' . $request->input('offer_type_id') . '%');
        }
        if ($request->has('gender_id')) {
            $query->where('gender_id', $request->input('gender_id'));
        }
        if ($request->has('offer_type_id')) {
            $query->where('offer_type_id', $request->input('offer_type_id'));
        }
        if ($request->has('location')) {
            $query->where('location', 'like', '%' . $request->input('location') . '%');
        }

        $pets_query = $query->paginate($this->pagination_amount);

        $data['pets'] = [];
        foreach ($pets_query as $index => $pet) {
            $data['pets'][$index] = getPetPreview($pet);
        }

        $paginationData = [
            'current_page' => $pets_query->currentPage(),
            'last_page' => $pets_query->lastPage(),
            'per_page' => $pets_query->perPage(),
            'total' => $pets_query->total(),
        ];

        return response()->json([
            'message' => 'here are my pets for adoption or sale',
            'paginationData' => $paginationData,
            'pets' => $data['pets'],
        ], 201);
    }
    
    public function getMyLostPets(Request $request) :JsonResponse
    {
        $user = Auth::user();

        $query = $user->lostPets();
        if ($request->has('race_id')) {
            $query->where('race_id', $request->input('race_id'));
        }
        if ($request->has('sub_race')) {
            $query->where('sub_race', 'like', '%' . $request->input('sub_race') . '%');
        }
        if ($request->has('offer_type_id')) {
            $query->where('offer_type_id', 'like', '%' . $request->input('offer_type_id') . '%');
        }
        if ($request->has('gender_id')) {
            $query->where('gender_id', $request->input('gender_id'));
        }
        if ($request->has('offer_type_id')) {
            $query->where('offer_type_id', $request->input('offer_type_id'));
        }
        if ($request->has('location')) {
            $query->where('location', 'like', '%' . $request->input('location') . '%');
        }

        $pets_query = $query->paginate($this->pagination_amount);

        $data['pets'] = [];
        foreach ($pets_query as $index => $pet) {
            $data['pets'][$index] = getLostPetPreview($pet);
        }

        $paginationData = [
            'current_page' => $pets_query->currentPage(),
            'last_page' => $pets_query->lastPage(),
            'per_page' => $pets_query->perPage(),
            'total' => $pets_query->total(),
        ];

        return response()->json([
            'message' => 'here are my lost pets',
            'paginationData' => $paginationData,
            'pets' => $data['pets'],
        ], 201);
    }

    public function showMyFavorites(Request $request) :JsonResponse
    {
        $user = Auth::user();

        $query = $user->savedPets();
        if ($request->has('race_id')) {
            $query->where('race_id', $request->input('race_id'));
        }
        if ($request->has('sub_race')) {
            $query->where('sub_race', 'like', '%' . $request->input('sub_race') . '%');
        }
        if ($request->has('offer_type_id')) {
            $query->where('offer_type_id', 'like', '%' . $request->input('offer_type_id') . '%');
        }
        if ($request->has('gender_id')) {
            $query->where('gender_id', $request->input('gender_id'));
        }
        if ($request->has('offer_type_id')) {
            $query->where('offer_type_id', $request->input('offer_type_id'));
        }
        if ($request->has('location')) {
            $query->where('location', 'like', '%' . $request->input('location') . '%');
        }

        $pets_query = $query->paginate($this->pagination_amount);

        $data['pets'] = [];
        foreach ($pets_query as $index => $pet) {
            $data['pets'][$index] = getLostPetPreview($pet);
        }

        $paginationData = [
            'current_page' => $pets_query->currentPage(),
            'last_page' => $pets_query->lastPage(),
            'per_page' => $pets_query->perPage(),
            'total' => $pets_query->total(),
        ];

        return response()->json([
            'message' => 'here are my favorite pets',
            'paginationData' => $paginationData,
            'pets' => $data['pets'],
        ], 201);
    }

    /* ------------------------------------------------ */

    public function getMyProfileForEdit(): JsonResponse
    {
        return response()->json([
            'message' => 'here data needed for screen',
            'wilayas' => getAllWilayas(),
        ]);
    }

    public function updateMyProfile(Request $request): JsonResponse
    {
        
        $user = Auth::user();
        $user->name = $request->name;
        $user->location = $request->location;
        $user->wilaya_name = getWilayaName($request->wilayaNumber);
        $user->wilaya_id = getWilayaId($request->wilayaNumber);
        $user->phone_number = str_replace(['(', ')', ' ', '-'], '', $request->phoneNumber);
        //$user->social_list = $request->social_list;

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

}
