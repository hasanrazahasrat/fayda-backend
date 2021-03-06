<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    
    protected $table = 'favorite';
    
    protected $fillable = [ 'user_id', 'product_id' ];

    public function product()
    {
        return $this->belongsTo(Item::class, 'product_id');
    }
}
