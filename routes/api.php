<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|   [x] login        [x] register     [x] logout     
|   [] add pet      [] delete pet   [] update pet   [] get edit pet
|   [] show profile [] list my pets [] delete profile
|   [] update profile [] get edit profile
|   [] like         [] unlike       [] save         [] unsave
|   [] comment      [] uncomment  
|   [] search       [] filter       [] pet latest
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*-----| PetController |-----*/
Route::controller(PetController::class)->group(function () {
    Route::get('/',             'all');                 
    Route::get('race/{race}',   'showByRace');          
    Route::get('/pets-latest',  'latest');              
    Route::get('/pets/{uuid}',  'showPet');             
    Route::get('/pets-latest/filter={filter}','latestByRace');
});

/*-----| SearchController |-----*/
Route::controller(SearchController::class)->group(function () {
    Route::get('/search?&keyword={keywords}','search');
    Route::get('/search?&keyword={keywords}&filter={filter}','searchFilter');
});

/*
|--------------------------------------------------------------------------
| Web Routes with Auth Middleware
|--------------------------------------------------------------------------
*/

/*-----| PetController |-----*/
Route::controller(PetController::class)->middleware(['auth'])->group(function () {
    Route::get('/add-pet',          'postPet');
    Route::post('/add-pet',         'storePet');                
    Route::post('/update-pet',      'updatePet');              
    Route::post('/delete-pet/{petId}',  'deleteWithoutBackupPet'); 
    Route::get('/update-pet/{petId}',   'editPet');        
});

/*-----| ProfileController |-----*/
Route::controller(ProfileController::class)->middleware(['auth'])->group(function () {
    Route::post('/my-pets',             'listMyPets');
    Route::post('/saved-list',          'getSavedList');
    Route::get('/showMyProfile',        'showMyProfile');        
    Route::get('/profile-edit-get',     'getMyProfileForEdit');                  
    Route::post('/profile-edit-update', 'updateMyProfile');              
});

/*-----| ActionController |-----*/
Route::controller(ActionController::class)->group(function () {
    Route::post('/like/{petId}',       'like');
    Route::post('/save/{petId}',       'save');
    Route::post('/unlike/{petId}',     'unlike');
    Route::post('/unsave/{petId}',     'unsave');
    Route::post('/comment/{petId}',    'comment');
    Route::post('/uncomment/{petId}',  'uncomment');
});
