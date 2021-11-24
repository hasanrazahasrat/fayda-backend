<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoyalityPoint extends Model
{
    protected $fillable = [
        'saudi_riyal',
        'royality_points',
        'status',
    ];

    protected $casts = [
        'status'    => 'boolean'
    ];
}
