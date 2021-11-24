<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\PromotionsItem;

class PromotionalOrder extends Model
{
    protected $guarded = ['item_id', 'quantity', 'user_id', 'order_id'];

    public function user()
   {
       return $this->belongsTo(User::class, 'user_id');
   }

   public function promotionalorder()
   {
       return $this->belongsTo(PromotionsItem::class, 'item_id');
   }
}
