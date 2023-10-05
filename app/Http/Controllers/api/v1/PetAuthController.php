<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Pet;
use App\Models\Race;
use App\Models\PetLost;
use App\Models\PetImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

/* [complted]
    [x] getPostPet()    //get info needed for the screen
    [x] postPet()       //add the pet in database
    [x] editPet()       //get info needed for the screen
    [x] updatePet()     //update pet in database
    [x] deleteWithoutBackupPet()    //delete pet from database without backup
*/

class PetAuthController extends Controller
{

    public function getPostPet(): JsonResponse
    {
        return response()->json([
            'message' => 'here data needed for post pet page',
            'wilayas' => getAllWilayas(),
            'races' => getAllRaces(),
        ]);
    }

    /*  inputs::
|    color: "Anycolor ",
|    birthday: "2023/03/11",
|    description: "Description for pet",
|    gender: 1,
|    location: "Algheiajbd",
|    name: "Name of the pet",
|    phoneNumber: "(05) 58054-300",
|    price: "5007,00",
|    race_id: 1,
|    subRace: "Sicamoia",
|    typeOffer: 1,
|    weight: "12.33",
|    wilaya_id: 16,
|   images[]
*/

    public function postPet(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'images' => 'required',
            'wilaya_number' => 'required',
            'race_id' => 'required',
            'typeOffer' => 'required',
            'gender' => 'required',
        ]);

        try {
            $user = Auth::user();
            $uuid = uniqid();

            $last_date_activated = Carbon::now();

            $pet = new Pet();
            $pet->uuid = $uuid;
            $pet->name = $request->name;
            $pet->location = $request->location;
            $pet->wilaya_name = getWilayaName($request->wilaya_number);
            $pet->wilaya_id = getWilayaId($request->wilaya_number);

            $pet->sub_race = $request->subRace;
            $pet->gender_id = $request->gender;
            //$pet->gender_name = getGenderName($request->gender);

            $pet->offer_type_id = $request->typeOffer;
            //$pet->offer_type_name = getOfferTypeName($request->typeOffer);

            $pet->price = $request->price;
            $pet->birthday = $request->birthday;
            $pet->color = $request->color;
            $pet->weight = $request->weight;
            $pet->description = $request->description;
            $pet->phone_number = $request->phoneNumber;

            $pet->last_date_activated = $last_date_activated;

            $pet->user_id = $user->id;
            $pet->race_id = $request->race_id;
            $pet->images = null;

            $pet->keywords = generateKeywords($pet);
            $pet->media_services_id = 1;
            
            $pet->save();

            $pet_images = [];

            foreach ($request->images as $index => $image) {
                if ($image != null) {
                    //$data = base64_decode($image);
                    $filename = 'race_' . $request->race_id .
                        '_usr_' . $user->id .
                        '_rndm_' . $uuid .
                        '_i_' . $index;
                    //Storage::put('public/pets/' . $filename, $data);
                    $result = Cloudinary::upload('data:image/png;base64,' . $image, [
                        'public_id' => $filename
                    ]);
                    $img_save = new PetImage();
                    $img_save->pet_id = $pet->id;
                    $img_save->image_url = $result->getSecurePath();
                    $img_save->meta = $pet->keywords;
                    $img_save->save();

                    array_push($pet_images, $result->getSecurePath());
                }
            }

            $pet_update = Pet::find($pet->id);
            $pet_update->images = json_encode($pet_images);
            $pet_update->save();

            return response()->json([
                'status' => true,
                'message' => 'Pet Created Successfully',
                'pet' => $pet,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function editPet($petId): JsonResponse
    {
        $user = Auth::user();
        try {
            $pet = $user->pets->find($petId);
            //$imagesArray = [];
            //foreach ($pet->getImages as $index => $image) {
            //    array_push($imagesArray, $image->image_url);
            //}
            $data['pet'] = getLostPetPreview($pet);
            return response()->json([
                'message' => 'here the editPet info needed for the screen',
                'pet' => getLostPetPreview($pet),
                'wilaya' => getAllWilaya(),
                'races' => getAllRaces(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'This isnt your pet',
            ], 400);
        }
    }
    public function editLostPet($petId): JsonResponse
    {
        $user = Auth::user();
        try {

            $pet = $user->lostPets->find($petId);
            
            $data['pet'] = getLostPetPreview($pet);
            return response()->json([
                'message' => 'here the editPet info needed for the screen',
                'pet' => getLostPetPreview($pet),
                'wilaya' => getAllWilaya(),
                'races' => getAllRaces(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'This isnt your pet',
            ], 400);
        }
    }

    /*  inputs::
|   name:petname
|   location:petlocation
|   wilaya_number:46
|   race_id:1
|   subRace:petSubRace
|   gender_id:0
|   typeOffer_id:0
|   price:
|   birthday:2022-08-07
|   color:petcolor
|   weight:petweight
|   description:petDescription
|   phoneNumber:0558054300
|   images[]
*/
    public function updatePet(Request $request, $petId): JsonResponse
    {
        $validateUser = Validator::make(
            $request->all(),
            [
                'images' => 'required',
                'wilaya_id' => 'required',
                'race_id' => 'required',
                'typeOffer' => 'required',
                'gender' => 'required',
            ]
        );

        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }

        $last_date_activated = Carbon::now();

        $pet = Pet::find($petId);
        $pet->name =  $request->name;
        $pet->location =  $request->location;
        $pet->wilaya_name =  getWilayaName($request->wilaya_id);
        $pet->wilaya_number =  $request->wilaya_id;

        $pet->race_name =  Race::find($request->race_id)->name;
        $pet->sub_race =  $request->sub_race;
        $pet->gender_id =  $request->gender;
        $pet->gender_name =  getGenderName($request->gender);

        $pet->offer_type_id =  $request->typeOffer;
        $pet->offer_type_name =  getOfferTypeName($request->typeOffer);

        $pet->price =  $request->price;
        $pet->birthday =  $request->birthday;
        $pet->color =  $request->color;
        $pet->weight =  $request->weight;
        $pet->description =  $request->description;
        $pet->phone_number_this_pet = $request->phoneNumber;
        $pet->last_date_activated = $last_date_activated;
        $pet->race_id =  $request->race_id;
        $pet->keywords = generateKeywords($pet);

        $pet->save();

        $imagesSaved = $pet->getImages;
        foreach ($request->images as $index => $image) {
            if ($image != null) {
                //check if the row is already saved
                if (filter_var($image, FILTER_VALIDATE_URL)) {
                    continue;
                } else {
                    //-->if not, means its new and time to update it or save it
                    //-->upload image
                    $filename = 'race_' . $request->race_id . '_usr_' . $pet->uder_id . '_rndm_' . $pet->uuid . '_i_' . $index;
                    $result = Cloudinary::upload('data:image/png;base64,' . $image, [
                        'public_id' => $filename
                    ]);
                    //-->check if current from database already handles an image
                    if (sizeof($imagesSaved) >= $index + 1) {
                        $imagesSaved[$index]->image_url = $result->getSecurePath();
                        $imagesSaved[$index]->save();
                    } else {
                        //-->if a totall new image then create a new relationship image
                        //save it into record
                        $img_save = new PetImage();
                        $img_save->pet_id = $pet->id;
                        $img_save->image_url = $result->getSecurePath();
                        $img_save->meta = $pet->keywords;
                        $img_save->save();
                    }
                }
            } else {
                //-->means its null, maybe remove or just not filled yet
                //-->check if cell not new
                if (sizeof($imagesSaved) >= $index + 1) {
                    //if the cell is already filled
                    if ($imagesSaved[$index]) {
                        $imagesSaved[$index]->delete();
                    }
                }
            }
        }

        return response()->json([
            'message' => 'updated successfully',
            'pet' => $pet
        ], 200);
    }

    public function deleteWithoutBackupPet($petId): JsonResponse
    {
        Pet::destroy($petId);

        return response()->json([
            'message' => 'pet deleted successfully without backup, why have u dont that :...)'
        ], 200);
    }
}
