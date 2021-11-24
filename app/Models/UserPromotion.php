<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPromotion extends Model
{
    protected $fillable = ['item_promotion_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function promotion()
    {
        return $this->belongsTo(ItemPromotion::class);
    }
}