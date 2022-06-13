<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\Pet;
use App\Models\Race;
use App\Models\Color;
use App\Models\Status;
use App\Models\Wilaya;
use App\Models\SubRace;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Auth;

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

    private function uniqueUuid($race, $name)
    {
        $uuidString = (string) Str::uuid();
        $uuidFirst = substr($uuidString, 0, 5);
        $uuid = $uuidFirst . '-' . $race. '-' . str_replace(" ", "", $name);
        return $uuid;
    }

    public function index()
    {
        $base1 = URL::to('/pets') . '/';
        //$base = env('APP_URL');
        $data['pets'] = [];
        $pets = Pet::all();
        //$pet = $pets->first();
        $races = Race::all();
        foreach ($pets as $key => $pet) {
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
        //return response()->json($data['pets'], 201);

        return view('home', ['pets' => $data_obj, 'races' => $races]);
    }

    public function race($race) {

        $selected_race = Race::where('name', strtolower($race))->first();

        $base1 = URL::to('/pets') . '/';
        //$base = env('APP_URL');
        $data['pets'] = [];
        $pets = $selected_race->pets;
        //$pet = $pets->first();
        $races = Race::all();
        foreach ($pets as $key => $pet) {
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
        if(Auth()->user()->pets->count() > 7) {
            toastr('You have reached the limit of 7pets ', $type = 'warning', $title = '', $options = [
                'positionClass' => 'toast-top-center',
                'timeOut'           => 3000,
            ]);
            toastr('Please delete some of your record ', $type = 'info', $title = '', $options = [
                'positionClass' => 'toast-top-center',
                'timeOut'           => 3000,
            ]);
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
     * Store a new Pet
     *
     */
    public function store(Request $request)
    {
        $uploadedFileUrl = [];
        $manyImages = count($request->imageCompressed);

        $dt = Carbon::createFromFormat('Y-m-d', $request->birthday)->format('Y-m-d');
        //$images = array_slice($request->file('images'), 0, 4);
        $status = $request->status;
        for($i = 0; $i < $manyImages; $i++) {
            //$uploadedFileUrl[$i] = Cloudinary::upload($request->imageCompressed[$i])->getSecurePath();
        }

        if($status == 'sell'){$status = 1;}
        if($status == 'adoption'){$status = 2;}
        if($status == 'rent'){$status = 3;}

        $raceName = Race::find($request->race)->name;
        $sub_raceName = SubRace::find($request->sub)->name;
        $wilayaName = Wilaya::find($request->wilaya)->name;
        $color = Color::find($request->color)->name;

        $pet = new Pet();
        $pet->uuid = $this->uniqueUuid($request->race ,$request->name);
        $pet->name = $request->name;
        $pet->user_id = Auth()->user()->id;
        $pet->race_id = $request->race;
        $pet->sub_race_id = $request->sub;
        $pet->status_id = $status;              //not setted
        $pet->wilaya_id = $request->wilaya;
        $pet->raceName = $raceName;
        $pet->sub_raceName = $sub_raceName;
        $pet->wilayaName = $wilayaName;
        $pet->gender = $request->gender;
        $pet->color = $color;
        $pet->date_birth = Carbon::parse("2021-11-01")->format('Y/m/d');
        $pet->size = $request->size;            //not setted
        $pet->pics = json_encode($uploadedFileUrl);
        $pet->description = $request->description;
        $pet->phone_number = json_encode($request->phone);
        $pet->tags = Race::find($request->race)->name . ', '
                    . SubRace::find($request->sub)->name . ', '
                    . Wilaya::find($request->wilaya)->name . ', '
                    . $request->gender . ', '
                    . $color . ', '
                    . $request->size . ', '
                    . $request->description ;

        $pet->save();
        toastr('Pet added successfully ', $type = 'success', $title = '', $options = [
            'positionClass' => 'toast-top-center',
            'timeOut'           => 3000,
        ]);

        return redirect()->route('pet.show', ['id' => $pet->id]);

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
            'uuid' => $pet->uuid,
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
            'phone_number' => json_decode($pet->phone_number)
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
            'uuid' => $pet->uuid,
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

        toastr('Pet updated successfully ', $type = 'success', $title = '', $options = [
            'positionClass' => 'toast-top-center',
            'timeOut'           => 3000,
        ]);
        return back();
    }

    public function delete(Request $request)
    {
        $user = Auth()->user();
        $selected_pet = $user->pets->find($request->id);
        $selected_pet->delete();

        toastr('Pet deleted successfully ', $type = 'success', $title = '', $options = [
            'positionClass' => 'toast-top-center',
            'timeOut'           => 3000,
        ]);
    }


}
