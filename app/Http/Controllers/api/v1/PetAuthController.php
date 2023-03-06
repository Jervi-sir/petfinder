<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PetAuthController extends Controller
{
    public function postPet() :JsonResponse
    {
        return response()->json('', 200);
    }

    public function editPet($petId) :JsonResponse
    {
        return response()->json('', 200);
    }

    public function storePet() :JsonResponse
    {
        return response()->json('', 200);
    }

    public function updatePet() :JsonResponse
    {
        return response()->json('', 200);
    }

    public function deleteWithoutBackupPet($petId) :JsonResponse
    {
        return response()->json('', 200);
    }
    
}
