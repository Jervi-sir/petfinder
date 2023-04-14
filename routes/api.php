<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\PetController;
use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\ActionController;
use App\Http\Controllers\api\v1\SearchController;
use App\Http\Controllers\api\v1\PetAuthController;
use App\Http\Controllers\api\v1\ProfileController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*-----| Authentication |-----*/
Route::prefix('v1/')->middleware('auth:sanctum')->group(function () {
    Route::post('register', [AuthController::class, 'register']);               //[]
    Route::post('login', [AuthController::class, 'login']);                     //[]
    Route::prefix('auth/')->middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);               //[]post
    });
});


Route::prefix('v1/auth/')->middleware('auth:sanctum')->group(function () {
    Route::prefix('pets/')->group(function () {
        Route::get('id/{id}',  [PetController::class, 'showPet']);                          //[]
        Route::get('race/{raceId}',   [PetController::class, 'showByRace']);                //[]
        Route::get('pets-latest',  [PetController::class, 'latest']);                       //[]
        Route::get('pets-latest/race={raceId}', [PetController::class, 'latestByRace']);    //[]
    });


    Route::prefix('pet/')->group(function () {
        Route::get('add-pet', [PetAuthController::class, 'getPostPet']);                    //[]
        Route::post('add-pet', [PetAuthController::class, 'postPet']);                      //[]
        Route::get('edit-pet/{petId}', [PetAuthController::class, 'editPet']);              //[]
        Route::post('edit-pet/{petId}', [PetAuthController::class, 'updatePet']);           //[]
    });

    Route::prefix('profile/')->group(function () {
        Route::get('show-my-profile', [ProfileController::class, 'showMyProfile']);         //[]
        Route::get('edit-profile', [ProfileController::class, 'getMyProfileForEdit']);      //[]
        Route::post('edit-profile', [ProfileController::class, 'updateMyProfile']);         //[]
        Route::get('saved-list', [ProfileController::class, 'getSavedList']);               //[]
    });

    Route::prefix('actions/')->group(function () {
        Route::post('save/{petId}',       [ActionController::class, 'save']);           //[]
        Route::post('unsave/{petId}',     [ActionController::class, 'unsave']);         //[]
        Route::post('archive/{petId}',  [ActionController::class, 'archive']);          //[]
        Route::post('unarchive/{petId}',  [ActionController::class, 'unarchive']);      //[]
        Route::post('deletepet/{petId}',  [ActionController::class, 'delete']);         //[]
    });
});


/*-----| PetController |-----*/
Route::prefix('v1/')->group(function () {
    Route::get('pet/{id}',  [PetController::class, 'showPet']);                         //[]
    Route::get('race/{raceId}',   [PetController::class, 'showByRace']);                //[]
    Route::get('pets-latest',  [PetController::class, 'latest']);                       //[]
    Route::get('pets-latest/race={raceId}', [PetController::class, 'latestByRace']);    //[]
});

/*-----| SearchController |-----*/
Route::prefix('search/')->group(function () {
    Route::get('/keyword={keywords}', [SearchController::class, 'search']);                         //[]
    Route::get('/keyword={keywords}&filter={filter}', [SearchController::class, 'searchFilter']);   //[]
});
