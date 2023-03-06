<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function search($keywords) :JsonResponse
    {
        return response()->json('$data', 201);
    }

    public function searchFilter($keywords, $filter) :JsonResponse
    {
        return response()->json('$data', 201);
    }
}
