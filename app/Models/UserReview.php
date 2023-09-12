<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReview extends Model
{
    use HasFactory;

      
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id', 'id');
    }

    public function reviewee()
    {
        return $this->belongsTo(User::class, 'reviewee_id', 'id');
    }
}
