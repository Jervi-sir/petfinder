<?php

namespace App\Models;

use App\Models\Pet;
use App\Models\SubRace;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Status extends Model
{
    use HasFactory;

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }



}
