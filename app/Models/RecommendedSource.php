<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecommendedSource extends Model
{
    use HasFactory;

    protected $fillable = [
        'source_type',
        'source_address',
        'profile_id',
    ];
}
