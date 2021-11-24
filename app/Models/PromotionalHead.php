<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PromotionsCategory;

class PromotionalHead extends Model
{
	protected $guarded = [ 'id', 'created_at', 'updated_at' ];
	
    public function getImageAttribute($value)
    {
        return asset('storage/' . $value);
    }
}
