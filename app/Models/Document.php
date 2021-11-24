<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'title',
        'status'
    ];

    protected $casts = ['status'=>'boolean'];
    public function getImagesAttribute($value)
    {
        return asset('storage/' . $value);
    }
}
