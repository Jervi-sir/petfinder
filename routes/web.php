<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

/*-----| PetController |-----*/
Route::controller(PetController::class)->group(function () {
    Route::get('/',             'index')->name('pet.all');              //done
    Route::get('race/{race}',   'race')->name('pet.race');              //done
    Route::get('/pets-latest',  'index')->name('pet.all');              //done
    Route::get('/pets/{uuid}',  'show')->name('pet.show');              //done
    Route::get('/pets-latest/filter={filter}','filter')->name('pet.filter');
});

/*-----| ActionController |-----*/
Route::controller(ActionController::class)->group(function () {
    Route::post('/like/{id}',       'like')->name('like');
    Route::post('/save/{id}',       'save')->name('save');
    Route::post('/unlike/{id}',     'unlike')->name('unlike');
    Route::post('/unsave/{id}',     'unsave')->name('unsave');
    Route::post('/comment/{id}',    'comment')->name('comment');
    Route::post('/uncomment/{id}',  'uncomment')->name('uncomment');
});

/*-----| SearchController |-----*/
Route::controller(SearchController::class)->group(function () {
    Route::post('/search','search')->name('pet.search');
});


/*
|--------------------------------------------------------------------------
| Web Routes with Auth Middleware
|--------------------------------------------------------------------------
*/
/*-----| PetController |-----*/
Route::controller(PetController::class)->middleware(['auth'])->group(function () {
    Route::get('/add-pet',          'create')->name('pet.create');
    Route::post('/add-pet',         'store')->name('pet.store');                //done
    Route::post('/update-pet',      'update')->name('pet.update');              //done
    Route::post('/delete-pet',      'deleteWithoutBackup')->name('pet.delete'); //done
    Route::get('/update-pet/{id}',  'edit')->name('pet.edit');        //images not yet
});

/*-----| ProfileController |-----*/
Route::controller(ProfileController::class)->middleware(['auth'])->group(function () {
    Route::get('/myprofile',        'myprofile')->name('profile.myprofile');        //done
    //Route::get('/pet-list',       'list')->name('profile.list');                  //done
    Route::get('/profile-edit',     'edit')->name('profile.edit');                  //done
    Route::post('/profile-edit',    'update')->name('profile.update');              //done
    Route::post('/saved-list',      'saved')->name('profile.saved');
});


Route::middleware(['auth', 'roleAdmin'])->group(function () {

});

/*
|--------------------------------------------------------------------------
| TODO routes
|--------------------------------------------------------------------------

- [z] add pet    -- images, turning id into numbers and stuffs
- [ ] edit pet
- [ ] delete pet
- [z] list all my pets
- [ ] edit profile
- [ ] pet latest
- [z] show one pet
- [ ] like
- [ ] unlike
- [ ] save
- [ ] unsave
- [ ] comment
- [ ] uncomment
- [ ] search
- [ ] filter
- [ ] message

*/
