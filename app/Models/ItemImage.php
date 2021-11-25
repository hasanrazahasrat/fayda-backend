<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        if (Str::startsWith($value, 'http'))
            return $value;

        return asset('files/' . $value);
    }

}
