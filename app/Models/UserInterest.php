<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserInterest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_profile_id',
        'interest',
        'interest_1',
        'interest_2',
        'interest_3',
    ];

    public function userProfileInterest(): BelongsTo
    {
        return $this->belongsTo(UserProfile::class);
    }
}
