<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EarnedPoint extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function getImageAttribute($value)
    {
        return asset('storage/' . $value);
    }
}
