<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'external_id',
        'category_id',
        'name',
        'price',
        'points',
        'details',
        'status',
        'name_ar',
        'details_ar',
        'user_id',
        'user_type'
    ];

    protected $casts = ['status'=>'boolean'];
    protected $appends = ['points'];

    public function category()
    {
        return  $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ItemImage::class, 'item_id');
    }

    public function getPointsAttribute($value)
    {
        $category = $this->category;
        return ($category->points * $this->price);
    }

}
