<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\Pet;
use App\Models\Race;
use App\Models\Color;
use App\Models\Status;
use App\Models\Wilaya;
use App\Models\SubRace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;


class PetController extends Controller
{
    private function getAge($date_birth)
    {
        $now = time(); // or your date as well
        $your_date = strtotime($date_birth);
        $datediff = $now - $your_date;
        $total = $datediff / (60 * 60 * 24);
        $age = '';
        if($total > 360) {
            $years = intval($total / 360);
            $total = $total - ($years * 360);
            $age = $years . 'y ';
        }
        if($total >= 30) {
            $leftMonths = intval($total % 30);
            $total = $total - ($leftMonths * 30);
            $age = $age . $leftMonths . 'm';
        }
        else {
            $leftDays = intval($total % 30);
            $total = $total - ($leftDays * 1);
            if(strpos($age, 'm') == false) {
                $age = $age . $leftDays . 'd';
            }
        }

        return $age;
    }

    public function index()
    {
        $base1 = URL::to('/pets') . '/';
        //$base = env('APP_URL');

        $pets = Pet::all();
        //$pet = $pets->first();
        $races = Race::all();
        foreach ($pets as $key => $pet) {
            $data['pets'][$key] = [
                'url' => $base1 . $pet->id,
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
        //return response()->json($data['pets'], 201);

        return view('home', ['pets' => $data_obj, 'races' => $races]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //check if user hits the limit of 7
        if(Auth()->user()->pets()->count() > 2) {
            return back();
        }
        $races = Race::all();
        $subRaces = SubRace::all();
        $wilayas = Wilaya::all();
        $colors = Color::all();
        $statuses = Status::all();
        return view('pets.add', [
            'races' => $races,
            'subRaces' => $subRaces,
            'wilayas' => $wilayas,
            'colors' => $colors,
            'statuses' => $statuses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dt = Carbon::createFromFormat('Y-m-d', $request->birthday)->format('Y-m-d');
        $images = array_slice($request->file('images'), 0, 4);
        $status = $request->status;

        if($status == 'sell' ){$status = 1;}
        if($status == 'adoption' ){$status = 2;}
        if($status == 'rent' ){$status = 3;}

        $pet = new Pet();
        $pet->name = $request->name;
        $pet->user_id = Auth()->user()->id;
        $pet->race_id = $request->race;
        $pet->sub_race_id = $request->sub;

        $pet->status_id = $status;      //not setted

        $pet->wilaya_id = $request->wilaya;
        $pet->gender = $request->gender;

        $color = Color::find($request->color)->first()->name;
        $pet->color = $color;
        $pet->date_birth = Carbon::parse("2021-11-01")->format('Y/m/d');
        //$request->birthday; sdate("Y/m/d")
        $pet->size = $request->size;            //not setted
        //$pet->pics = $request->file('images');
        $pet->pics = ('s');
        $pet->description = $request->description;
        $pet->phone_number = json_encode($request->phone);
        $pet->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pet = Pet::find($id);

        $age = $this->getAge($pet->date_birth);

        $data['pet'] = [
            'name' => $pet->name,
            'gender' => $pet->gender,
            'race' => $pet->race->name,
            'subRace' => $pet->subRace->name,
            'status' => $pet->status->name,
            'wilaya' => $pet->wilaya->name,
            'status' => $pet->status->name,
            'date_birth' => $age,
            'size' => $pet->size,
            'color' => $pet->color,
            'image' => $pet->pics,
            'description' => $pet->description,
            'phone_number' => $pet->phone_number,
        ];
        return view("pets.show", ['pet' => $data['pet']]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pet = Pet::find($id);
        $data['pet'] = [
            'id' => $pet->id,
            'name' => $pet->name,
            'gender' => $pet->gender,
            'race' => $pet->race_id,
            'subRace' => $pet->subRace_id,
            'status' => $pet->status_id,
            'wilaya' => $pet->wilaya_id,
            'status' => $pet->status_id,
            'date_birth' => $pet->date_birth,
            'size' => $pet->size,
            'color' => $pet->color,
            'image' => $pet->pics,
            'description' => $pet->description,
            'phone_number' => $pet->phone_number,
        ];

        $races = Race::all();
        $subRaces = SubRace::all();
        $wilayas = Wilaya::all();
        $colors = Color::all();
        $statuses = Status::all();

        return view('pets.edit', [
            'pet' => $data['pet'],
            'races' => $races,
            'subRaces' => $subRaces,
            'wilayas' => $wilayas,
            'colors' => $colors,
            'statuses' => $statuses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $pet = Pet::find($request->id);

        $images = array_slice($request->file('images'), 0, 4);
        $status = $request->status;

        if($status == 'sell' ){$status = 1;}
        if($status == 'adoption' ){$status = 2;}
        if($status == 'rent' ){$status = 3;}

        $pet->name = $request->name;

        $pet->status_id = $status;      //not setted

        $pet->wilaya_id = $request->wilaya;
        $pet->gender = $request->gender;

        $color = Color::find($request->color)->first()->name;
        $pet->color = $color;
        $pet->date_birth = Carbon::parse($request->birthday)->format('Y/m/d');
        //$request->birthday; sdate("Y/m/d")
        $pet->size = $request->size;            //not setted
        //$pet->pics = $request->file('images');
        $pet->pics = ('s');
        $pet->description = $request->description;
        $pet->phone_number = json_encode($request->phone);
        $pet->save();
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        dd($request);
    }

    public function delete(Request $request)
    {
        dd($request);
    }
}
