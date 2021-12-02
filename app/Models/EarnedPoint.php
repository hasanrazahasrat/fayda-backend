<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EarnedPoint extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getImageAttribute($value)
    {
        if (Str::startsWith($value, 'http')) {
            return $value;
        }

        return asset('storage/' . $value);
    }
}
