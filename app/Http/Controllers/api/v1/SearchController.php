<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Pet;
use App\Models\PetLost;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public $pagination_amount = 8;
    
    public function searchPets(Request $request) :JsonResponse
    {
        $query = Pet::query();
        if ($request->has('race_id')) {
            $query->where('race_id', $request->input('race_id'));
        }
        if ($request->has('sub_race')) {
            $query->where('sub_race', 'like', '%' . $request->input('sub_race') . '%');
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
        if ($request->has('keywords')) {
            $query->where('keywords', 'like', '%' . $request->input('keywords') . '%')
                ->orWhere('description', 'like', '%' . $request->input('keywords') . '%')
                ->orWhere('name', 'like', '%' . $request->input('keywords') . '%');
        }

        $pets_query = $query->paginate(10);

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
            'message' => 'here are latest pets',
            'paginationData' => $paginationData,
            'pets' => $data['pets'],
        ], 201);
    }


    public function searchLostPets(Request $request) :JsonResponse
    {
        $query = PetLost::query();
        if ($request->has('race_id')) {
            $query->where('race_id', $request->input('race_id'));
        }
        if ($request->has('sub_race')) {
            $query->where('sub_race', 'like', '%' . $request->input('sub_race') . '%');
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
        if ($request->has('keywords')) {
            $query->where('keywords', 'like', '%' . $request->input('keywords') . '%')
                ->orWhere('description', 'like', '%' . $request->input('keywords') . '%')
                ->orWhere('name', 'like', '%' . $request->input('keywords') . '%');
        }

        $pets_query = $query->paginate(10);

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
            'message' => 'here are latest pets',
            'paginationData' => $paginationData,
            'pets' => $data['pets'],
        ], 201);
    }

    public function searchFilter($keywords, $filter) :JsonResponse
    {
        return response()->json('$data', 201);
    }
}
