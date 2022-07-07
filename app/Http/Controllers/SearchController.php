<?php

namespace App\Http\Controllers;


use App\Models\Pet;
use App\Models\Race;
use Illuminate\Http\Request;

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

        //create a collection of db that has keyword score 1
        $keyword_score_1 = [];
        foreach ($eng_keywords as $key => $value) {
            if($value['score'] == 1) {
                //remove the used keyword
                array_shift($eng_keywords);
                array_push($keyword_score_1, $value['keyword']);
            }
        }
        if(!empty($keyword_score_1)) {
            $result = Pet::whereIn('raceName', $keyword_score_1);
        }

        //filter what we found
        foreach($eng_keywords as $word){
            $result->where('keywords', 'LIKE', '%'.$word['keyword'].'%');
        }
        $results = getPets($result->get());

        if($request->resultNeeded == 'json') {
            return response()->json($results);
        } else {
            $races = Race::all();
            return view('home', ['count' => count((array)$results),
                                'pets' => $results,
                                'races' => $races]);
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
