<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NameGeneratorController extends Controller
{
    public function generateName(Request $request) {
        $colors = $request->colors;
        $gender = $request->gender;
        $theme = $request->theme;
        $characteristic = $request->characteristic;  //playful, shy, energetic, large, small
        $race = $request->race;
        $sub_race = $request->sub_race;


    }
}
