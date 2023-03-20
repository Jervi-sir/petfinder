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
    public function save($petId) :JsonResponse
    {
        $save = new Save();
        $save->user_id = Auth::user()->id;
        $save->pet_id = $petId;
        $save->save();

        return response()->json('User saved the pet', 200);
    }

    public function unsave($petId) :JsonResponse
    {
        $save = Save::where('user_id', Auth::user()->id)->where('pet_id', $petId)->first();
        $save->delete();
        return response()->json('User unsaved the pet', 200);
    }
}
