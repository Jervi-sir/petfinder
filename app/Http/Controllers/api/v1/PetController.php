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

    public function latestPets(Request $request) :JsonResponse
    {
        $query = Pet::query();
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
            'message' => 'here are latest pets',
            'paginationData' => $paginationData,
            'pets' => $data['pets'],
        ], 201);
    }

    public function latestLostPets(Request $request) :JsonResponse
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
            'message' => 'here are latest pets',
            'paginationData' => $paginationData,
            'pets' => $data['pets'],
        ], 201);
    }
    /*-----------------*/




    public function showByRace($raceId): JsonResponse
    {
        $pets = Pet::where('race_id', $raceId)->paginate($this->pagination_amount);
        foreach ($pets as $index => $pet) {
            $data['pets'][$index] = getPetPreview($pet);
        }
        return response()->json([
            'message' => 'here are pet by race u ve specified',
            'selected_race' => $raceId,
            'pets' => $data['pets'],
            'last_page' => $pets->lastPage(),
        ], 201);
    }



    public function latestByRace($raceId): JsonResponse
    {
        $startTime = microtime(true);

        $race = Race::find($raceId);
        if (!$race) return response()->json(['message' => 'race doesnt exists']);
        $pets = $race->pets()->latest()->paginate($this->pagination_amount);
        //$pets = Pet::latest()->where('race_id', $raceId)->paginate($this->pagination_amount);
        foreach ($pets as $index => $pet) {
            $data['pets'][$index] = getPetPreview($pet);
        }

        $endTime = microtime(true);
        $totalTime = $endTime - $startTime;

        return response()->json([
            'time' => 'Execution time: ' . number_format($totalTime, 2) . ' seconds',
            'message' => 'here are pet by race u ve specified',
            'selected_race' => $raceId,
            'last_page' => $pets->lastPage(),
            'pets' => $data['pets'],
        ], 201);
    }
}
