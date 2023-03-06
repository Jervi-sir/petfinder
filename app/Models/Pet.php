<?php

namespace App\Models;

use App\Models\Race;
use App\Models\User;
use App\Models\Wilaya;
use App\Models\OfferType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pet extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'uuid',
        'name',

        'location',

        'race',
        'gender',
        'colorName',
        'birthday',
        'pics',
        'description',
        'phone_number',

        'is_active',
        'status',
        'last_date_activated',

        'keywords',

        'user_id',
        'race_id',
        'offer_type_id',
        'wilaya_id',
    ];


    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function race() :BelongsTo
    {
        return $this->belongsTo(Race::class);
    }

    public function offerType() :BelongsTo
    {
        return $this->belongsTo(OfferType::class);
    }

    public function wilaya() :BelongsTo
    {
        return $this->belongsTo(Wilaya::class);
    }

}
