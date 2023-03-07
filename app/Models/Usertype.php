<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usertype extends Model
{
    use HasFactory;

    public function getUsers() :HasMany
    {
        return $this->hasMany(User::class);
    }
}
