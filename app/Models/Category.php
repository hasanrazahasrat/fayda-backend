<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Category extends Model
{
    protected $fillable = ['title', 'title_ar','status', 'points', 'images'];
    protected $casts = ['status' => 'boolean'];

    public function item()
    {
        return  $this->hasMany(Item::class);
    }
    
    public function getImagesAttribute($value)
    {
        return asset('storage/' . $value);
    }
    
    public function user(){
        return $this->hasMany(User::class);
    }
}
