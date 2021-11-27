<?php

namespace App\Http\Controllers;

use toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
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
        //
    }

    public function myprofile()
    {
        $base1 = URL::to('/update-pet') . '/';

        $user = Auth()->user();
        $data['user'] = [
            'name' => $user->name,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
        ];

        $pets = $user->pets()->get();
        //$pet = $pets->first();
        if($pets->count()) {
            $count = $pets->count();
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
                    'age' => $this->getAge($pet->date_birth),
                ];
            }
        }
        else {
            $data['pets'][0] = '';
            $count = 0;
        }

        //$user = (object)$data['user'];
        //$pets = (object)$data['pets'];
        return view('profile.mine', ['pets' => $data['pets'],
                                    'user' => $user,
                                    'count' => $count
                                ]);
    }

    public function edit()
    {
        $user = Auth()->user();
        $data['user'] = [
            'name' => $user->name,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            //'location' => $user->location,
            'image' => $user->pic,
        ];

        $user = (object)$data['user'];
        return view('profile.edit', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $user = Auth()->user();
        $user->name = $request->name;
        $user->phone_number = $request->phone;
        $user->pic = $request->image;
        $user->save();

        toastr('Profile updated successfully ', $type = 'success', $title = '', $options = [
            'positionClass' => 'toast-top-center',
            'timeOut'           => 3000,
        ]);
        return redirect()->route('profile.myprofile');
    }

    public function delete(Request $request)
    {
        dd($request);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

}
