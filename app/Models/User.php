<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Pet;
use App\Models\Like;
use App\Models\Role;
use App\Models\Save;
use App\Models\Comment;
use App\Models\Usertype;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getUsertype() :BelongsTo
    {
        return $this->belongsTo(Usertype::class);
    }

    public function getRole() :BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function getPets() :HasMany
    {
        return $this->hasMany(Pet::class);
    }

    public function getCommentedPets() :HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function getLikedPets() :HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function getSavedPets() :HasMany
    {
        return $this->hasMany(Save::class);
    }
    
}
