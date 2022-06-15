<?php

namespace App\Http\Controllers;

use toastr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'image' => profileImageUrl($user->pic),
            'phone_number' => $user->phone_number,
        ];

        $pets = $user->pets;
        //$pet = $pets->first();
        if($pets->count()) {
            $count = $pets->count();
            $data['pets'] = getPets($pets);

        }
        else {
            $data['pets'][0] = '';
            $count = 0;
        }

        //$user = (object)$data['user'];
        //$pets = (object)$data['pets'];
        return view('profile.mine', ['pets' => $data['pets'],
                                    'user' => $data['user'],
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
            'image' => profileImageUrl($user->pic),
            //'location' => $user->location,
        ];

        $user = (object)$data['user'];
        return view('profile.edit', ['user' => $data['user']]);
    }

    public function update(Request $request)
    {
        $user = Auth()->user();
        if($user->pic != null) {
            Storage::disk('profileImage')->delete($user->pic);
        }

        $file = explode( ',', $request->imageCompressed )[1];
        $filename= str_replace("-", "", Str::uuid()->toString()).'.png';
        Storage::disk('profileImage')->put($filename, base64_decode($file));

        $user->name = $request->name;
        $user->phone_number = $request->phone;
        $user->pic = $filename;
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

}
