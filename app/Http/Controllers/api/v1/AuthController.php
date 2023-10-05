<?php

namespace App\Http\Controllers\api\v1;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register(Request $request) :JsonResponse 
    {
        try {
            //Validated
            $validateUser = Validator::make($request->all(), 
            [
                'name' => 'required',
                'phone_number' => 'required|unique:users,phone_number',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                //'email' => $request->email,
                'password' => Hash::make($request->password),
                'password_notHashed' => $request->password,
                
                'role_id' => Role::where('name', 'user')->first()->id,
                'where_registered' => $request->deviceType,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken($user->phone_number)->plainTextToken,
                'user_auth_info' => getProfileData($user),
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function login(Request $request) :JsonResponse
    {
        try {
            $validateUser = Validator::make($request->all(), 
            [
                'phone_number' => 'required',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['phone_number', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Phone_number & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('phone_number', $request->phone_number)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken($user->phone_number)->plainTextToken,
                'user_auth_info' => getProfileData($user),

            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request) :JsonResponse
    {
        //$request->user()->tokens()->delete();
        auth()->user()->currentAccessToken()->delete();

        return response()->json([
        'message' => 'Successfully logged out'
        ]);
    }

    public function validateToken(Request $request)
    {
        $user = auth()->user();

        return response()->json([
            'status' => 'success', 
            'message' => 'Token is valid',
            'user_auth_info' => getProfileData($user)
        ]);
    }

}
