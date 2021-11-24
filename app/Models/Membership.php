<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = [
        'title',
        'tier',
        'badge_image',
        'card_image',
        'badge_image_sm',
    ];
    
    
     public function membership()
    {
        return  $this->belongsTo(Tier::class);
    }
    
    public function getBadgeImageAttribute($value)
    {
        return asset('storage/' . $value);
    }
    
    public function getCardImageAttribute($value)
    {
        return asset('storage/' . $value);
    }
    
    public function getBadgeImageSmAttribute($value)
    {
        return asset('storage/' . $value);
    }
}
