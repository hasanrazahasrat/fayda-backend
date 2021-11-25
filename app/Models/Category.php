<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = ['title', 'title_ar','status', 'points', 'images', 'merchant_id', 'external_id'];
    protected $casts = ['status' => 'boolean'];

    public function item()
    {
        return  $this->hasMany(Item::class);
    }

    public function getImagesAttribute($value)
    {
        if (Str::startsWith($value, 'http'))
            return $value;

        return asset('files/' . $value);
    }

    public function user(){
        return $this->hasMany(Merchant::class);
    }
}
