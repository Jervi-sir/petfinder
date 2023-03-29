<?php

namespace App\Models;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Save extends Pivot
{
    use HasFactory;

    protected $table = 'saves';
    public $incrementing = true;
    protected $guarded = ['id'];
}
