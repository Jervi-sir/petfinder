<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function myprofile()
    {
        $user = Auth()->user();
        $data['user'] = [
            'name' => $user->name,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
        ];

        $pets = $user->pets()->get();
        //$pet = $pets->first();
        
        foreach ($pets as $key => $pet) {
            $data['pets'][$key] = [
                'id' => $pet->id,
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

        $user = (object)$data['user'];
        $pets = (object)$data['pets'];
        return view('profile.mine', ['pets' => $pets,'user' => $user]);
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

        return redirect()->route('profile.myprofile');
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
    public function destroy($id)
    {
        //
    }
}
