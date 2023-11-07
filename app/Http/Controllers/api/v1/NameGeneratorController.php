<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\PetName;
use Illuminate\Http\Request;

class NameGeneratorController extends Controller
{
    public function generateName(Request $request) {

        $query = PetName::query();

        $colors = $request->colors;
        $gender = $request->gender;
        $theme = $request->theme;
        $characteristic = $request->characteristic;  //playful, shy, energetic, large, small
        $race = $request->race;
        $sub_race = $request->sub_race;

        $petNames = $query->inRandomOrder()->take(5)->get();
        foreach ($petNames as $index => $name) {
            $data['names'][$index] = [$name->name];
        }
        return response()->json([
            'names' => $data['names']
        ]);

    }
}
