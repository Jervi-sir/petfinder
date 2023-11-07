<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\PetController;
use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\ActionController;
use App\Http\Controllers\api\v1\NameGeneratorController;
use App\Http\Controllers\api\v1\SearchController;
use App\Http\Controllers\api\v1\PetAuthController;
use App\Http\Controllers\api\v1\ProfileController;
use App\Models\User;
use Stevebauman\Location\Facades\Location;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::get('test', function(Request $request) {
    $ip = $request->ip();
    $location = Location::get($ip);
    if ($location) {
        // Successfully retrieved location
        return response()->json([
            'country' => $location->countryName,
            'city' => $location->cityName,
            // ... you can return more data as needed
        ]);
    } else {
        // Location not found
        return response()->json(['error' => 'Location not found.'], 404);
    }

});

Route::middleware('auth:sanctum')->get('v1/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1/')->group(function () {
    /*-----| Authentication |-----*/
    Route::post('register', [AuthController::class, 'register']);       //[api done][]
    Route::post('login', [AuthController::class, 'login']);             //[api done][]
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);       //[api done][]
        Route::get('validate_token', [AuthController::class, 'validateToken']);
    });
    /*-----| Helpers |-----*/
    Route::get('add-pet-helpers', [PetAuthController::class, 'getPostPet']);              //[][]

    /*-----| Pets |-----*/
    RoutePets();
    RouteLostPets();

    //Route::post('generate-name'. [NameGeneratorController::class, 'generateName']);
    /*-----| Authenticated |-----*/
    Route::prefix('auth/')->middleware('auth:sanctum')->group(function () {

        /*-----| Profile |-----*/
        Route::prefix('profile/')->group(function () {
            Route::get('show-my-profile', [ProfileController::class, 'showMyProfile']);         //[api done][]
            Route::get('show-my-favorites', [ProfileController::class, 'showMyFavorites']);     //[api done][]

            Route::get('edit-profile', [ProfileController::class, 'getMyProfileForEdit']);      //[][]
            Route::post('edit-profile', [ProfileController::class, 'updateMyProfile']);         //[][]
        });
        /*-----| Pets |-----*/
        RoutePets();
        RouteLostPets();
        Route::get('list-my-pets', [ProfileController::class, 'getMyPets']);                //[api done][]
        Route::get('list-my-lost-pets', [ProfileController::class, 'getMyLostPets']);       //[api done][]

        /*-----| Pet |-----*/
        Route::prefix('pet/')->group(function () {
            Route::get('add-pet-helpers', [PetAuthController::class, 'getPostPet']);              //[][]
            Route::post('add', [PetAuthController::class, 'postPet']);                      //[][]
            Route::get('edit/{petId}', [PetAuthController::class, 'editPet']);              //[api done][]
            Route::post('update/{petId}', [PetAuthController::class, 'updatePet']);         //[][]
        });
        /*-----| Pet |-----*/
        Route::prefix('lostpet/')->group(function () {
            //Route::get('add-pet', [PetAuthController::class, 'getPostPet']);              //[][]
            Route::post('add', [PetAuthController::class, 'postLostPet']);                  //[][]
            Route::get('edit/{petId}', [PetAuthController::class, 'editLostPet']);          //[api done][]
            Route::post('update/{petId}', [PetAuthController::class, 'updateLostPet']);     //[][]
        });

        /*-----| Actions |-----*/
        Route::prefix('actions/')->group(function () {
            Route::post('save',         [ActionController::class, 'save']);           //[api done][]
            Route::post('unsave',       [ActionController::class, 'unsave']);         //[api done][]
            Route::post('archive',      [ActionController::class, 'archive']);          //[api done][]
            Route::post('unarchive',    [ActionController::class, 'unarchive']);      //[api done][]
            Route::post('deletepet',    [ActionController::class, 'delete']);         //[api done][]
        });
    });
});


/*-----| Adoption and Lost Pets |-----*/
function RoutePets() {
    Route::prefix('pets/')->group(function () {
        Route::get('id/{id}',  [PetController::class, 'showPet']);      //[api done][]
        Route::get('search', [SearchController::class, 'searchPets']);  //[api done][]
        Route::get('latest',  [PetController::class, 'latestPets']);    //[api done][]
    });
}

/*-----| Lost Pets |-----*/
function RouteLostPets() {
    Route::prefix('lostpets/')->group(function () {
        Route::get('id/{id}',  [PetController::class, 'showLostPet']);      //[api done][]
        Route::get('search', [SearchController::class, 'searchLostPets']);  //[api done][]
        Route::get('latest',  [PetController::class, 'latestLostPets']);    //[api done][]

    });
}



Route::get('v1/request', function (Request $request) {
    return reponse()->json([
        'ip' => $request->ip(),
        'headers' => $request->headers->all(),
        'userAgent' => $request->header('User-Agent'),
        'method' => $request->method(),
        'url' => $request->fullUrl(),
        'uri' => $request->path(),
        'cookies' => $request->cookies->all(),
        'serverParams' => $request->server(),
        'serverParams' => $request->server(),
    ]);
});
