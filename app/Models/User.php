<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Pet;
use App\Models\Role;
use App\Models\Save;
use App\Models\User;
use App\Models\UserReview;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'pic',
        'phone_number',
        'location',
        'wilaya_name',
        'wilaya_number',
        'social_list'
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

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class);
    }

    public function savedPets(): BelongsToMany
    {
        return $this->belongsToMany(Pet::class, 'saves')->using(Save::class)->withTimestamps();;
    }

    
    public function reviewsWritten()
    {
        return $this->hasMany(UserReview::class, 'reviewer_id', 'id');
    }

    public function reviewsReceived()
    {
        return $this->hasMany(UserReview::class, 'reviewee_id', 'id');
    }
 

}
