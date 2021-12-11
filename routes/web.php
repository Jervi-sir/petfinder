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
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';



Route::get('/', [PetController::class, 'index'])->name('pet.all');       //done
Route::get('/pets-latest', [PetController::class, 'index'])->name('pet.all');       //done
Route::get('/pets/{id}', [PetController::class, 'show'])->name('pet.show');         //done

Route::post('/like/{id}', [ActionController::class, 'like'])->name('like');
Route::post('/unlike/{id}', [ActionController::class, 'unlike'])->name('unlike');
Route::post('/save/{id}', [ActionController::class, 'save'])->name('save');
Route::post('/unsave/{id}', [ActionController::class, 'unsave'])->name('unsave');

Route::post('/comment/{id}', [ActionController::class, 'comment'])->name('comment');
Route::post('/uncomment/{id}', [ActionController::class, 'uncomment'])->name('uncomment');

Route::get('/pets-latest/filter={filter}', [PetController::class, 'filter'])->name('pet.filter');
Route::post('/search', [SearchController::class, 'search'])->name('pet.search');


Route::middleware(['auth'])->group(function () {
    Route::get('/add-pet', [PetController::class, 'create'])->name('pet.create');           //done
    Route::post('/add-pet', [PetController::class, 'store'])->name('pet.store');            //done
    Route::get('/update-pet/{id}', [PetController::class, 'edit'])->name('pet.edit');       //images not yet
    Route::post('/update-pet', [PetController::class, 'update'])->name('pet.update');       //done
    Route::post('/delete-pet', [PetController::class, 'delete'])->name('pet.delete');       //done

    Route::get('/myprofile',[ProfileController::class, 'myprofile'])->name('profile.myprofile');        //done        //done
    Route::get('/profile-edit',[ProfileController::class, 'edit'])->name('profile.edit');               //done
    Route::post('/profile-edit',[ProfileController::class, 'update'])->name('profile.update');          //done
    //Route::get('/pet-list',[ProfileController::class, 'list'])->name('profile.list');
    Route::post('/saved-list',[ProfileController::class, 'saved'])->name('profile.saved');
});


Route::middleware(['auth', 'roleAdmin'])->group(function () {

});

/*

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
