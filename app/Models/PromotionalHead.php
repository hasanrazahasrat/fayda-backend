<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PromotionsCategory;

class PromotionalHead extends Model
{
	protected $guarded = [ 'id', 'title', 'title_ar', 'description', 'description_ar', 'created_at', 'updated_at' ];

    public function getImageAttribute($value)
    {
        return asset('files/' . $value);
    }
}
