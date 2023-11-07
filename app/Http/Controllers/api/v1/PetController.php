<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Pet;
use App\Models\Race;
use App\Models\PetLost;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class PetController extends Controller
{
    public $pagination_amount = 8;

    public function showPet($id): JsonResponse
    {
        $pet = Pet::find($id);
        $data['pet'] = getPetDetailed($pet);
        return response()->json([
            'message' => 'here is the pet u ve asked for',
            'pet' => $data['pet'],
        ], 201);
    }

    public function showLostPet($id): JsonResponse
    {
        $pet = PetLost::find($id);
        $data['pet'] = getLostPetDetailed($pet);
        return response()->json([
            'message' => 'here is the pet u ve asked for',
            'pet' => $data['pet'],
        ], 201);
    }

    public function latestPets(Request $request) : JsonResponse
    {

        $query = Pet::query();


        // Apply ordering based on wilaya_id
        // This will create an ordered list where wilaya_id 46 will be at the top
        if ($request->has('wilaya_id')) {
            $wilayaId = intval($request->input('wilaya_id'));
            $query->orderByRaw(
                "CASE WHEN wilaya_id = ? THEN 0 ELSE 1 END, id DESC",
                [$wilayaId]
            );
        } else {
            $query->orderBy('id', 'desc');
        }

        // Apply additional filters
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
        // The wilaya_id filter is already applied in the ordering, so we don't need to filter by it again.

        $pets_query = $query->paginate($this->pagination_amount);

        $data['pets'] = [];
        foreach ($pets_query as $index => $pet) {
            $data['pets'][$index] = getPetPreview($pet); // make sure getPetPreview is accessible, might need $this->getPetPreview($pet) if it's a method of this class
        }

        $paginationData = [
            'current_page' => $pets_query->currentPage(),
            'next_page' => $pets_query->currentPage() + 1,
            'last_page' => $pets_query->lastPage(),
            'per_page' => $pets_query->perPage(),
            'total' => $pets_query->total(),
        ];

        // Check if the next page is greater than the last page
        if ($paginationData['next_page'] > $paginationData['last_page']) {
            $paginationData['next_page'] = null; // Or any indicator that there is no next page
        }

        return response()->json([
            'message' => 'here are latest pets',
            'paginationData' => $paginationData,
            'pets' => $data['pets'],
        ], 201);
    }

    public function latestLostPets(Request $request) :JsonResponse
    {
        $query = PetLost::query();

        // Apply ordering based on wilaya_id
        // This will create an ordered list where wilaya_id 46 will be at the top
        if ($request->has('wilaya_id')) {
            $wilayaId = intval($request->input('wilaya_id'));
            $query->orderByRaw(
                "CASE WHEN wilaya_id = ? THEN 0 ELSE 1 END, id DESC",
                [$wilayaId]
            );
        } else {
            $query->orderBy('id', 'desc');
        }

        // Apply additional filters
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
        // The wilaya_id filter is already applied in the ordering, so we don't need to filter by it again.

        $pets_query = $query->paginate($this->pagination_amount);

        $data['pets'] = [];
        foreach ($pets_query as $index => $pet) {
            $data['pets'][$index] = getLostPetPreview($pet); // make sure getPetPreview is accessible, might need $this->getPetPreview($pet) if it's a method of this class
        }

        $paginationData = [
            'current_page' => $pets_query->currentPage(),
            'next_page' => $pets_query->currentPage() + 1,
            'last_page' => $pets_query->lastPage(),
            'per_page' => $pets_query->perPage(),
            'total' => $pets_query->total(),
        ];

        // Check if the next page is greater than the last page
        if ($paginationData['next_page'] > $paginationData['last_page']) {
            $paginationData['next_page'] = null; // Or any indicator that there is no next page
        }

        return response()->json([
            'message' => 'here are latest pets',
            'paginationData' => $paginationData,
            'pets' => $data['pets'],
        ], 201);
    }
    /*-----------------*/
}
