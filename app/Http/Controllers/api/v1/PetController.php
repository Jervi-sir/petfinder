<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Pet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class PetController extends Controller
{
    public function latest() :JsonResponse
    {
        $pets = Pet::latest()->get();
        foreach($pets as $index => $pet) {
            $data['pets'][$index] = getPetPreview($pet);
        }
        return response()->json([
            'message' => 'here are latest pets',
            'pets' => $data['pets'],
        ], 201);
    }

    public function showByRace($raceId) :JsonResponse
    {
        $pets = Pet::where('race_id', $raceId)->get();
        foreach($pets as $index => $pet) {
            $data['pets'][$index] = getPetPreview($pet);
        }
        return response()->json([
            'message' => 'here are pet by race u ve specified',
            'selected_race' => $raceId,
            'pets' => $data['pets'],
        ], 201);
    }

    public function showPet($id) :JsonResponse
    {
        $pet = Pet::find($id);
       
        $data['pet'] = getPetDetailed($pet);
        return response()->json([
            'message' => 'here is the pet u ve asked for',
            'pet' => $data['pet'],
        ], 201);

    }

    public function latestByRace($raceId) :JsonResponse
    {
        $pets = Pet::latest()->where('race_id', $raceId)->get();
        foreach($pets as $index => $pet) {
            $data['pets'][$index] = getPetDetailed($pet);
        }
        return response()->json([
            'message' => 'here are pet by race u ve specified',
            'selected_race' => $raceId,
            'pets' => $data['pets'],
        ], 201);
        return response()->json('', 201);
    }
}
