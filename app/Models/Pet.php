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
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',

        'location',
        'wilaya_name',
        'wilaya_number',

        'race_name',
        'sub_race',
        'gender',

        'offer_type_number',
        'price',

        'birthday',
        'color',
        'weight',
        'description',
        'is_active',
        'last_date_activated',
        'keywords',

        'user_id',
        'race_id',

    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class);
    }

    public function getUserWhoSaved(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'saves')->using(Save::class);
    }

    public function getImages(): HasMany
    {
        return $this->hasMany(PetImage::class);
    }
}
