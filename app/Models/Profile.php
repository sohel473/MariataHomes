<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Profile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'date_of_birth',
        'telephone',
        'next_of_kin',
        'passport_photograph',
        'any_illness',
        'last_residence_address',
        'user_id',
        'recommended_source_id',
    ];

    protected function passportPhotograph(): Attribute {
        return Attribute::make(
            get: function($value) {
                return $value ? '/storage/passports/' . $value : '/default_pic.jpg';
            }
        );
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<string>
     */
    protected $hidden = [
        // Add any attributes you want to hide
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_birth' => 'date',
        // other casts if necessary
    ];

    /**
     * Get the user associated with the profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recommendedSource()
    {
        return $this->belongsTo(RecommendedSource::class);
    }
    
}
