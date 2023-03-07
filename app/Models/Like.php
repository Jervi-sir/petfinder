<?php

namespace App\Models;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    use HasFactory;

    public function getPet() :BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }
    
    public function getUser() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
