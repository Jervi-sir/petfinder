<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Race;
use App\Models\Color;
use App\Models\Status;
use App\Models\Wilaya;
use App\Models\SubRace;
use Illuminate\Http\Request;


class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pets = Pet::all();
        $pet = $pets->first();

        foreach ($pets as $key => $pet) {
            $data['pets'][$key] = [
                'name' => $pet->name,
                'race' => $pet->race->first()->name,
                'subRace' => $pet->subRace->first()->name,
                'status' => $pet->status->first()->name,
                'image' => $pet->pics,
                'slug' => $pet->id,
            ];
        }

        //return response()->json($data, 201);

        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        dd($request);
        $pet = new Pet();
        $pet->name = $request->name;
        $pet->user_id = Auth()->user()->id;
        $pet->race_id = $request->race_id;
        $pet->sub_race_id = $request->sub_race_id;
        $pet->status_id = $request->status_id;

        $pet->wilaya_id = $request->wilaya_id;
        $pet->gender = $request->gender;

        $color = Color::find($request->color)->first()->name;
        $pet->color = $color;
        $pet->date_birth = $request->date_birth;
        $pet->size = $request->size;
        $pet->pics = $request->file('images');
        $pet->description = $request->description;
        $pet->phone_number = $request->phone_number;
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

        /*return view('pets.show', [
            'pet' => $pet,
        ]);
        */
        return view("pets.show");
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

        return view('pets.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
