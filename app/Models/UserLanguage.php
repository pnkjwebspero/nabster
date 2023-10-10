<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserLanguage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_profile_id',
        'primary_language',
        'additional_language_1',
        'additional_language_2',
        'additional_language_3',
    ];

    public function userProfileLang(): BelongsTo
    {
        return $this->belongsTo(UserProfile::class);
    }
}
