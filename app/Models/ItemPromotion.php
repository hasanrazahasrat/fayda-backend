<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPromotion extends Model
{
    protected $fillable = [
        'p_category','item','ip_detail','image'	
    ];
    
    public function getImageAttribute($value)
    {
        return asset('storage/' . $value);
    }
}
