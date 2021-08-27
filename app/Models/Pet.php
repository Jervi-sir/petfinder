<?php

namespace App\Models;

use App\Models\Race;
use App\Models\User;
use App\Models\Status;
use App\Models\SubRace;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pet extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    public function subRace()
    {
        return $this->belongsTo(SubRace::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }



}
