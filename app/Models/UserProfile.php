<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\UserLanguage;
use App\Models\UserInterest;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'birthdate',
        'primary_language',
        'additional_language',
        'location',
        'interests',
        'profile_image',
        'profile_image_thumbnail',
        'banner_image',
        'nationality',
        'family_nationality',
        'gender',
        'orientation',
        'relationship',
        'religion',
        'education_level',
        'field_of_study',
        'current_career_field',
        'aspiring_career_field'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function userLanguage(): hasOne
    {
        return $this->hasOne(UserLanguage::class);
    }

    public function userInterest(): hasOne
    {
        return $this->hasOne(UserLanguage::class);
    }
}
