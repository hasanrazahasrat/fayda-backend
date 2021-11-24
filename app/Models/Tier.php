<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tier extends Model
{
    protected $fillable = [
        'tier_name',
        'tier_points',
        'status'
    ];

    protected $casts = [
        'status'    => 'boolean'
    ];
    
    public function membership() 
    {
        return $this->hasMany(Membership::class, 'tier');
    }
}
