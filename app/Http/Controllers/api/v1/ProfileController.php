<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showMyProfile() :JsonResponse
    {
        return response()->json('', 200);
    }
    public function getMyProfileForEdit() :JsonResponse
    {
        return response()->json('', 200);
    }
    public function listMyPets() :JsonResponse
    {
        return response()->json('', 200);
    }
    public function updateMyProfile() :JsonResponse
    {
        return response()->json('', 200);
    }
    public function getSavedList() :JsonResponse
    {
        return response()->json('', 200);
    }

}
