<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    public function like($petId) :JsonResponse
    {   
        $like = new Like();
        return response()->json('', 200);
    }

    public function unlike($petId) :JsonResponse
    {
        return response()->json('', 200);
    }

    public function comment($petId) :JsonResponse
    {
        return response()->json('', 200);
    }

    public function uncomment($petId) :JsonResponse
    {
        return response()->json('', 200);
    }

    public function save($petId) :JsonResponse
    {
        return response()->json('', 200);
    }

    public function unsave($petId) :JsonResponse
    {
        return response()->json('', 200);
    }
}
