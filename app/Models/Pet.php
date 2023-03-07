<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Race;
use App\Models\Save;
use App\Models\User;
use App\Models\Wilaya;
use App\Models\Comment;
use App\Models\PetImage;
use App\Models\OfferType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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


    public function getUser() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getRace() :BelongsTo
    {
        return $this->belongsTo(Race::class);
    }

    public function getOfferType() :BelongsTo
    {
        return $this->belongsTo(OfferType::class);
    }

    public function getWilaya() :BelongsTo
    {
        return $this->belongsTo(Wilaya::class);
    }

    public function getLikes() :HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function getComments() :HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function getSaves() :HasMany
    {
        return $this->hasMany(Save::class);
    }

    public function getImages() :HasMany
    {
        return $this->hasMany(PetImage::class);
    }
}
