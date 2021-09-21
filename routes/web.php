<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\ProfileController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/add-pet', [PetController::class, 'create'])->name('pet.create');
Route::post('/add-pet', [PetController::class, 'store'])->name('pet.store');
Route::get('/update-pet/{id}', [PetController::class, 'edit'])->name('pet.edit');
Route::post('/update-pet/{id}', [PetController::class, 'update'])->name('pet.update');
Route::post('/delete-pet/{id}', [PetController::class, 'delete'])->name('pet.delete');

Route::get('/profile-edit',[ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile-edit',[ProfileController::class, 'update'])->name('profile.update');
Route::get('/pet-list',[ProfileController::class, 'list'])->name('profile.list');
Route::post('/saved-list',[ProfileController::class, 'saved'])->name('profile.saved');

Route::get('/pets-latest', [PetController::class, 'index'])->name('pet.all');
Route::get('/pets/{id}', [PetController::class, 'show'])->name('pet.show');

Route::post('/like/{id}', [ActionController::class, 'like'])->name('like');
Route::post('/unlike/{id}', [ActionController::class, 'unlike'])->name('unlike');
Route::post('/save/{id}', [ActionController::class, 'save'])->name('save');
Route::post('/unsave/{id}', [ActionController::class, 'unsave'])->name('unsave');

Route::post('/comment/{id}', [ActionController::class, 'comment'])->name('comment');
Route::post('/uncomment/{id}', [ActionController::class, 'uncomment'])->name('uncomment');

Route::get('/pets-latest/filter={filter}', [PetController::class, 'filter'])->name('pet.filter');
Route::get('/search', [PetController::class, 'search'])->name('pet.search');


/*


- [ ] add pet
- [ ] edit pet
- [ ] delete pet
- [ ] list all my pets
- [ ] edit profile
- [ ] pet latest
- [ ] show ome pet
- [ ] like
- [ ] unlike
- [ ] save
- [ ] unsave
- [ ] comment
- [ ] uncomment
- [ ] search
- [ ] filter
- [ ] message

\*/
