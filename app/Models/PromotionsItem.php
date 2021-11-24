<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PromotionsCategory;

class PromotionsItem extends Model
{
	protected $guarded = [ 'id', 'created_at', 'updated_at' ];
	
    public function getImageAttribute($value)
    {
        return asset('storage/' . $value);
    }
    
    public function PromotionsCategory()
    {
        return $this->belongsTo(PromotionsCategory::class);
    }
    
    public function promotionalorder() 
    {
        return $this->hasMany(PromotionalOrder::class);
    }
}
