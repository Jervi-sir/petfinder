<?php

namespace App\Models;

use App\Models\Race;
use App\Models\Save;
use App\Models\User;
use App\Models\Gender;
use App\Models\Wilaya;
use App\Models\PetImage;
use App\Models\OfferType;
use App\Models\LostPetPost;
use App\Models\AdoptionSalePost;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PetLost extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class);
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    public function offerType(): BelongsTo
    {
        return $this->belongsTo(OfferType::class);
    }

    public function wilaya(): BelongsTo
    {
        return $this->belongsTo(Wilaya::class);
    }

    public function getUserWhoSaved(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'saves')->using(Save::class);
    }

    public function getImages(): HasMany
    {
        return $this->hasMany(PetImage::class);
    }

    /* for polumorphic plan in future
    public function adoptionSalePost()
    {
        return $this->hasOne(AdoptionSalePost::class);
    }

    public function lostPetPost()
    {
        return $this->hasOne(LostPetPost::class);
    }
    */

}
