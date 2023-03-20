<?php

namespace App\Models;

use App\Models\Pet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PetImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'pet_id',
        'image_url',
        'meta',
    ];

    public function getPet() :BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }
}
