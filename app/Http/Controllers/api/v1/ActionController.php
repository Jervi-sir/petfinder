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
    public function save(Request $request): JsonResponse
    {
        $petId = $request->pet_id;
        $user = Auth::user();
        $user->savedPets()->syncWithoutDetaching([$petId]);
        return response()->json('User saved the pet', 200);
    }

    public function unsave(Request $request): JsonResponse
    {
        $petId = $request->pet_id;
        $user = Auth::user();
        $user->savedPets()->detach([$petId]);
        return response()->json('User unsaved the pet', 200);
    }

    public function archive(Request $request): JsonResponse
    {
        $petId = $request->pet_id;
        $user = Auth::user();
        $pet = $user->savedPets->where('id', $petId)->first();
        $pet->is_active = 0;
        $pet->save();
        return response()->json('User archived the pet', 200);
    }

    public function unarchive(Request $request): JsonResponse
    {
        $petId = $request->pet_id;
        $user = Auth::user();
        $pet = $user->savedPets->where('id', $petId)->first();
        $pet->is_active = 1;
        $pet->save();
        return response()->json('User archived the pet', 200);
    }

    public function delete(Request $request): JsonResponse
    {
        $petId = $request->pet_id;
        $user = Auth::user();
        $pet = $user->getPets->where('id', $petId)->first();
        if (!$pet) {
            return response()->json('Pet not found', 404);
        }
        $pet->delete();
        return response()->json('deleted successfully', 200);
    }
}
