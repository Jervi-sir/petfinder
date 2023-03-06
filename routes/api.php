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
    Route::get('/',             'all');              //done
    Route::get('race/{race}',   'race');              //done
    Route::get('/pets-latest',  'latest');              //done
    Route::get('/pets/{uuid}',  'show');              //done
    Route::get('/pets-latest/filter={filter}','filter');
});


/*-----| SearchController |-----*/
Route::controller(SearchController::class)->group(function () {
    Route::get('/search','search');
});
/*

|--------------------------------------------------------------------------
| Web Routes with Auth Middleware
|--------------------------------------------------------------------------
*/

/*-----| PetController |-----*/
Route::controller(PetController::class)->middleware(['auth'])->group(function () {
    Route::get('/add-pet',          'create');
    Route::post('/add-pet',         'store');                //done
    Route::post('/update-pet',      'update');              //done
    Route::post('/delete-pet',      'deleteWithoutBackup'); //done
    Route::get('/update-pet/{id}',  'edit');        //images not yet
});

/*-----| ProfileController |-----*/
Route::controller(ProfileController::class)->middleware(['auth'])->group(function () {
    Route::get('/myprofile',        'myprofile');        //done
    //Route::get('/pet-list',       'list')->name('profile.list');                  //done
    Route::get('/profile-edit',     'edit');                  //done
    Route::post('/profile-edit',    'update');              //done
    Route::post('/saved-list',      'saved');
});

/*-----| ActionController |-----*/
Route::controller(ActionController::class)->group(function () {
    Route::post('/like/{id}',       'like');
    Route::post('/save/{id}',       'save');
    Route::post('/unlike/{id}',     'unlike');
    Route::post('/unsave/{id}',     'unsave');
    Route::post('/comment/{id}',    'comment');
    Route::post('/uncomment/{id}',  'uncomment');
});
