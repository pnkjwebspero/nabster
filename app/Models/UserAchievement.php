<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAchievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_profile_id',
        'achievement',
        'achievement_1',
        'achievement_2',
        'achievement_3',
    ];

    public function userProfileAchievement(): BelongsTo
    {
        return $this->belongsTo(UserProfile::class);
    }
}
