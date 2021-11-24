<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemImage extends Model
{
    protected $fillable = [
        'image',
        'item_id'
    ];
    
    public function item()
    {
        return  $this->belongsTo(Item::class);
    }
    
    public function getImageAttribute($value)
    {
        return asset('storage/' . $value);
    }
    
}
