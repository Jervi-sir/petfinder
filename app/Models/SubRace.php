<?php

namespace App\Models;

use App\Models\Pet;
use App\Models\Race;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubRace extends Model
{
    use HasFactory;

    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }
    
}
