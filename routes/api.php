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
|   [x] login        [x] register     [x] logout     
|   [x] add pet      [x] delete pet   [x] update pet   [x] get edit pet
|   [x] show profile [x] list my pets [] delete profile
|   [x] update profile [x] get edit profile
|   [x] like         [x] unlike       [x] save         [x] unsave
|   [x] comment      [x] uncomment  
|   [] search       [] filter       [] pet latest
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*-----| Authentication |-----*/
Route::controller(AuthController::class)->group(function () {
    Route::post('/v1/register', 'register');        //[done][done]   
    Route::post('/v1/login',    'login');           //[done][done]   
    Route::middleware('auth:sanctum')->post('/v1/logout', 'logout');    //[done] 
});



/*-----| PetController |-----*/
Route::controller(PetController::class)->group(function () {
    Route::get('/',             'all');                 
    Route::get('race/{race}',   'showByRace');          
    Route::get('/pets-latest',  'latest');              
    Route::get('/pet/{uuid}',  'showPet');             
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
Route::controller(PetAuthController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/v1/get-add-pet',          'getPostPet');       //[done][done]           
    Route::post('/v1/add-pet',              'postPet');         //[done][done]   

    Route::get('/v1/edit-pet/{petId}',      'editPet');      //[done]        
    Route::post('/v1/update-pet/{petId}',   'updatePet');   //[done]        
    Route::post('/v1/delete-pet/{petId}',   'deleteWithoutBackupPet');   //[done]
});

/*-----| ProfileController |-----*/
Route::controller(ProfileController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/v1/showMyProfile',        'showMyProfile');        //[done][]     

    Route::get('/v1/my-pets',             'listMyPets');            //[done]
    Route::get('/v1/saved-list',          'getSavedList');
    Route::get('/v1/profile-edit-get',     'getMyProfileForEdit');  //[done]                 
    Route::post('/v1/profile-edit-update', 'updateMyProfile');      //[done]
});


/*-----| ActionController |-----*/
Route::controller(ActionController::class)->middleware('auth:sanctum')->group(function () {
    Route::post('/v1/like/{petId}',       'like');      //[done]
    Route::post('/v1/save/{petId}',       'save');      //[done]
    Route::post('/v1/unlike/{petId}',     'unlike');    //[done]
    Route::post('/v1/unsave/{petId}',     'unsave');    //[done]
    Route::post('/v1/comment/{petId}',    'comment');   //[done]
    Route::post('/v1/uncomment/{petId}',  'uncomment'); //[done]
});
