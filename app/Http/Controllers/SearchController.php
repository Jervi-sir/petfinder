<?php

namespace App\Http\Controllers;


use App\Models\Pet;
use App\Models\Race;
use App\Models\Translation;
use Carbon\Translator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class SearchController extends Controller
{

    //helper for checking if record does exists by id
    private function checkExistsId($array, $id)
    {
        for ($i = 0; $i < count($array); $i++)
        {
            if($array[$i]['id'] == $id)
            {
                return true;
            }
        }

        return false;
    }

    public function search(Request $request)
    {
        //turn keywords single line string into a keyword array
        $eng_keywords = translateToEnglish($request->keywords);
        $pets = Pet::where('keywords', 'like', '%'. $eng_keywords[0] . '%');
        dd($eng_keywords);
        //remove first keyword
        array_shift($eng_keywords);

        foreach($eng_keywords as $keyword)
        {
            $pets = $pets->where('keywords', 'like', '%'. $keyword . '%');
        }

        $results = $pets->get();
        dd($results);

        $base1 = URL::to('/pets') . '/';

        foreach ($results as $key => $pet) {
            $data['pets'][$key] = [
                'url' => $base1 . $pet->id,             //use uuid
                'name' => $pet->name,
                'gender' => $pet->gender,
                'race' => $pet->race->name,
                'subRace' => $pet->subRace->name,
                'status' => $pet->status->name,
                'wilaya' => $pet->wilaya->name,
                'status' => $pet->status->name,
                'image' => $pet->pics,
            ];
        }

        $data_obj = (object)$data['pets'];

        if($request->resultNeeded == 'json') {
            return response()->json($data_obj);
        } else {
            $races = Race::all();
            return view('home', ['pets' => $data_obj, 'races' => $races]);
        }

    }

}


/*---------------
    public function search(Request $request)
    {
        $keywords = explode(" ", $request->keyword);
        $results['pets'] = [['id' => '']];
        $base1 = URL::to('/pets') . '/';

        foreach($keywords as $keyword)
        {
            $pets = Pet::where('tags', 'like', '%' . $keyword . '%')->get();
            foreach($pets as $pet)
            {
                $data = [
                    'id' => $pet->id,             //use uuid
                    'url' => $base1 . $pet->id,             //use uuid
                    'name' => $pet->name,
                    'gender' => $pet->gender,
                    'race' => $pet->race->name,
                    'subRace' => $pet->subRace->name,
                    'status' => $pet->status->name,
                    'wilaya' => $pet->wilaya->name,
                    'status' => $pet->status->name,
                    'image' => $pet->pics,
                ];

                //check if exists
                if(!$this->checkExistsId($results['pets'], $pet->id))
                {
                    array_push($results['pets'], $data);
                }
            }
        }
        //remove first empty element
        array_shift($results['pets']);

        $data_obj = (object)$results['pets'];
        //return response()->json($data['pets'], 201);
        if($request->resultNeeded == 'json') {
            return response()->json($data_obj);
        } else {
            $races = Race::all();
            return view('home', ['pets' => $data_obj, 'races' => $races]);
        }
    }


----------------*/
