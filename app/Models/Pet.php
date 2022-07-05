<?php

namespace App\Models;

use App\Models\Race;
use App\Models\User;
use App\Models\Wilaya;
use App\Models\OfferType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',

        'gender',
        'color',
        'birth_date',
        'size',
        'pics',
        'description',
        'phone_number',

        'user_id',
        'race_id',
        'offer_type_id',
        'wilaya_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    public function offerType()
    {
        return $this->belongsTo(OfferType::class);
    }

    public function wilaya()
    {
        return $this->belongsTo(Wilaya::class);
    }

}
