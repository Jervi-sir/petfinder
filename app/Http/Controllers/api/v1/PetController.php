<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Pet;
use App\Models\Race;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class PetController extends Controller
{
    public $pagination_amount = 8;

    public function latest(): JsonResponse
    {
        $pets = Pet::latest()->paginate($this->pagination_amount);
        foreach ($pets as $index => $pet) {
            $data['pets'][$index] = getPetPreview($pet);
        }
        return response()->json([
            'message' => 'here are latest pets',
            'pets' => $data['pets'],
            'last_page' => $pets->lastPage(),
        ], 201);
    }


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

    public function showPet($id): JsonResponse
    {
        $pet = Pet::find($id);
        $data['pet'] = getPetDetailed($pet);
        return response()->json([
            'message' => 'here is the pet u ve asked for',
            'pet' => $data['pet'],
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
