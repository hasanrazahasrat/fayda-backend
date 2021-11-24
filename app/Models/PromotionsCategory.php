<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromotionsCategory extends Model
{
	protected $guarded = [ 'id', 'created_at', 'updated_at' ];
	
    public function promotionsItems()
    {
        return $this->hasMany(PromotionsItem::class);
    }
}
