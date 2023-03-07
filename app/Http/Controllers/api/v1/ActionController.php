<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Save;
use Illuminate\Support\Facades\Auth;

class ActionController extends Controller
{
    public function like($petId) :JsonResponse
    {   
        $like = new Like();
        $like->user_id = Auth::user()->id;
        $like->pet_id = $petId;
        $like->save();

        return response()->json('User like the pet', 200);
    }

    public function unlike($petId) :JsonResponse
    {
        $like = Like::where('user_id', Auth::user()->id)->where('pet_id', $petId)->first();
        $like->destroy();
        return response()->json('User unlike the pet', 200);
    }

    public function comment(Request $request, $petId) :JsonResponse
    {
        return response()->json('User comment the pet', 200);

        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->pet_id = $petId;
        $comment->comment = $request->comment;
        $comment->save();

        return response()->json('User comment the pet', 200);
    }

    public function uncomment($petId) :JsonResponse
    {
        $comment = Comment::where('user_id', Auth::user()->id)->where('pet_id', $petId)->first();
        $comment->delete();
        return response()->json('User uncomment the pet', 200);
    }

    public function save($petId) :JsonResponse
    {
        $save = new Save();
        $save->user_id = Auth::user()->id;
        $save->pet_id = $petId;
        $save->save();

        return response()->json('User save the pet', 200);
    }

    public function unsave($petId) :JsonResponse
    {
        $save = Save::where('user_id', Auth::user()->id)->where('pet_id', $petId)->first();
        $save->delete();
        return response()->json('User unsave the pet', 200);
    }
}
