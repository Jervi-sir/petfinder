<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\PetController;
use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\ActionController;
use App\Http\Controllers\api\v1\SearchController;
use App\Http\Controllers\api\v1\PetAuthController;
use App\Http\Controllers\api\v1\ProfileController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|   [x] login           [x] register        [x] logout  
|   [x] get add pet     [x] add pet         [x] delete pet       
|   [x] update pet      [x] get edit pet
|   [x] show profile    [x] list my pets    [x] delete profile
|   [x] update profile  [x] get edit profile
|   [x] save            [x] unsave
|   [x] search          [x] filter           [x] pet latest
*/

Route::get('test', function (Request $request) {
    $user = User::all();
    return response()->json($user);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*-----| Authentication |-----*/
Route::prefix('v1/')->group(function () {
    Route::post('register', [AuthController::class, 'register']);               //[verified]
    Route::post('login', [AuthController::class, 'login']);                     //[verified]
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);               //[verified]
    });
});


Route::prefix('v1/auth/')->middleware('auth:sanctum')->group(function () {
    Route::prefix('pets/')->group(function () {
        Route::get('id/{id}', [PetController::class, 'showPet']);                           //[verified]
        Route::get('race/{raceId}', [PetController::class, 'showByRace']);                  //[verified]
        Route::get('latest', [PetController::class, 'latest']);                             //[verified]
        Route::get('latest/race={raceId}', [PetController::class, 'latestByRace']);         //[verified]
    });


    Route::prefix('pet/')->group(function () {
        Route::get('add-pet', [PetAuthController::class, 'getPostPet']);                    //[verified]
        Route::post('add-pet', [PetAuthController::class, 'postPet']);                      //[verified]
        Route::get('edit-pet/{petId}', [PetAuthController::class, 'editPet']);              //[verified]
        Route::post('edit-pet/{petId}', [PetAuthController::class, 'updatePet']);           //[verified]
    });

    Route::prefix('profile/')->group(function () {
        Route::get('show-my-profile', [ProfileController::class, 'showMyProfile']);         //[verified]
        Route::get('edit-profile', [ProfileController::class, 'getMyProfileForEdit']);      //[verified]
        Route::post('edit-profile', [ProfileController::class, 'updateMyProfile']);         //[verified]
        Route::get('saved-list', [ProfileController::class, 'getSavedList']);               //[verified]
    });

    Route::prefix('actions/')->group(function () {
        Route::post('save/{petId}',       [ActionController::class, 'save']);           //[verified]
        Route::post('unsave/{petId}',     [ActionController::class, 'unsave']);         //[verified]
        Route::post('archive/{petId}',  [ActionController::class, 'archive']);          //[verified]
        Route::post('unarchive/{petId}',  [ActionController::class, 'unarchive']);      //[verified]
        Route::post('deletepet/{petId}',  [ActionController::class, 'delete']);         //[verified]
    });
});


/*-----| PetController |-----*/
Route::prefix('v1/pets/')->group(function () {
    Route::get('id/{id}',  [PetController::class, 'showPet']);                         //[verified]
    Route::get('race/{raceId}',   [PetController::class, 'showByRace']);                //[verified]
    Route::get('latest',  [PetController::class, 'latest']);                            //[verified]
    Route::get('latest/race={raceId}', [PetController::class, 'latestByRace']);         //[verified]
});

/*-----| SearchController |-----*/
Route::prefix('search/')->group(function () {
    Route::get('/keyword={keywords}', [SearchController::class, 'search']);                         //[verified]
    Route::get('/keyword={keywords}&filter={filter}', [SearchController::class, 'searchFilter']);   //[verified]
});
