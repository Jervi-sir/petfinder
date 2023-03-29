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
|   [] save             [] unsave
|   [] search           [] filter           [x] pet latest
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*-----| Authentication |-----*/
Route::controller(AuthController::class)->group(function () {
    Route::post('/v1/register', 'register');        //api[done]
    Route::post('/v1/login',    'login');           //api[done]
    Route::middleware('auth:sanctum')->post('/v1/logout', 'logout');    //api[done]    
});


/*-----| PetController |-----*/
Route::controller(PetController::class)->group(function () {
    Route::get('/v1/pet/{id}',  'showPet');             //api[done]
    Route::get('/v1/race/{raceId}',   'showByRace');    //api[done]
    Route::get('/v1/pets-latest',  'latest');           //api[done]
    Route::get('/v1/pets-latest/race={raceId}', 'latestByRace'); //api[done]
});


/*-----| SearchController |-----*/
Route::controller(SearchController::class)->group(function () {
    Route::get('/search?&keyword={keywords}', 'search');
    Route::get('/search?&keyword={keywords}&filter={filter}', 'searchFilter');
});

Route::controller(PetController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/v1/auth/pet/{id}',  'showPet');             //api[done]
    Route::get('/v1/auth/race/{raceId}',   'showByRace');    //api[done]
    Route::get('/v1/auth/pets-latest',  'latest');           //api[done]
    Route::get('/v1/auth/pets-latest/race={raceId}', 'latestByRace'); //api[done]
});


/*
|--------------------------------------------------------------------------
| Web Routes with Auth Middleware
|--------------------------------------------------------------------------
*/

/*-----| PetController |-----*/
Route::controller(PetAuthController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/v1/get-add-pet',           'getPostPet');       //api[done]
    Route::post('/v1/add-pet',              'postPet');         //api[done]
    Route::get('/v1/edit-pet/{petId}',      'editPet');         //api[done]
    Route::post('/v1/update-pet/{petId}',   'updatePet');       //api[done]
    Route::post('/v1/delete-pet/{petId}',   'deleteWithoutBackupPet');  //api[done]
});

/*-----| ProfileController |-----*/
Route::controller(ProfileController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/v1/showMyProfile',        'showMyProfile');        //api[done]
    Route::get('/v1/profile-edit-get',     'getMyProfileForEdit');  //api[done]
    Route::post('/v1/profile-edit-update', 'updateMyProfile');      //api[done]
    Route::get('/v1/saved-list',           'getSavedList');         //api[]
});


/*-----| ActionController |-----*/
Route::controller(ActionController::class)->middleware('auth:sanctum')->group(function () {
    Route::post('/v1/save/{petId}',       'save');
    Route::post('/v1/unsave/{petId}',     'unsave');
});
