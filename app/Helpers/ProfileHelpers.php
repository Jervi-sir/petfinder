<?php


function profileImageUrl($image)
{
    $base_image = URL::to('/profileImages') . '/';
    return $base_image . $image;
}


function getProfileData($user) {
    return [
        'id' => $user->id,
        'uuid' => $user->uuid,
        'name' => $user->name,
        'phone_number' => $user->phone_number,
        'email' => $user->email,
        'gender_id' => $user->gender_id,
        'gender_name' => $user->gender_id && $user->gender->name,
        'pic' => $user->pic ? $user->pic : null,
        'location' => $user->location,
        'wilaya_id' => $user->wilaya_id,
        'wilaya_name' => $user->wilaya_id && $user->wilaya->name,
        'wilaya_number' => $user->wilaya_id && $user->wilaya->number,
        'socials' => $user->socials,
        'is_verified' => $user->is_verified,
        'firstName' => $user->firstName,
        'lastName' => $user->lastName,
        'bio' => $user->bio,
        'role_name' => $user->role->name,
        'total_pets_proposed' => $user->pets->count(),
        'total_pets_lost' => $user->lostPets->count(),
        //'pic' => $user->pic ? apiUrl() . 'storage/users/' . $user->pic : null,
    ];
}


