<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Save;
use Illuminate\Support\Facades\Auth;

class ActionController extends Controller
{
    public function save($petId): JsonResponse
    {
        $user = Auth::user();
        $user->getSavedPets()->syncWithoutDetaching([$petId]);
        return response()->json('User saved the pet', 200);
    }

    public function unsave($petId): JsonResponse
    {
        $user = Auth::user();
        $user->getSavedPets()->detach([$petId]);
        return response()->json('User unsaved the pet', 200);
    }
}
