<?php

namespace App\Models;

use App\Models\Pet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Race extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'details',
    ];

    public function getPets() :HasMany
    {
        return $this->hasMany(Pet::class);
    }
}
