<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public $pagination_amount = 8;
    
    public function search(Request $request) :JsonResponse
    {
        $pets = Pet::where('')->paginate($this->pagination_amount);
        foreach ($pets as $index => $pet) {
            $data['pets'][$index] = getPetPreview($pet);
        }
        return response()->json([
            'message' => 'here are latest pets',
            'pets' => $data['pets'],
            'last_page' => $pets->lastPage(),
        ], 201);
    }

    public function searchFilter($keywords, $filter) :JsonResponse
    {
        return response()->json('$data', 201);
    }
}
