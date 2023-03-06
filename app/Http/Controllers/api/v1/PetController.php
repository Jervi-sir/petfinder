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
        return response()->json('', 201);
    }

    public function latest() :JsonResponse
    {
        return response()->json('', 201);
    }

    public function showByRace($race) :JsonResponse
    {
        return response()->json('', 201);
    }

    public function showPet($uuid) :JsonResponse
    {
        return response()->json('', 201);
    }

    public function latestByRace($filter) :JsonResponse
    {
        return response()->json('', 201);
    }
}
