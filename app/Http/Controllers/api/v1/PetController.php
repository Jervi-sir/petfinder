<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Pet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class PetController extends Controller
{
    public function all() :JsonResponse
    {
        $pets = Pet::all();
        $pet = $pets->first();

        foreach ($pets as $key => $pet) {
            $data['pets'][$key] = [
                'name' => $pet->name,
                'race' => $pet->race->first()->name,
                'subRace' => $pet->subRace->first()->name,
                'status' => $pet->status->first()->name,
                'image' => $pet->pics,
                'slug' => $pet->id,
            ];
        }

        return response()->json($data, 201);
    }
}
