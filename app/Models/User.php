<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Models\Category;
use App\Models\Order;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile', 'business_name', 'business_address', 'status', 'loyalty_points', 'image', 'name_ar', 'business_address_ar', 'business_name_ar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'status'    =>  'boolean'
    ];

    protected $appends = [
        'membership'
    ];
    
   protected $primaryKey = 'id';
    

    public function getTierAttribute()
    {
        $tiers = Tier::orderBy('tier_points', 'asc')->get();
        $prev = $next = null;
        foreach($tiers as $i => $tier) {
            if ($prev == null) {
                if ($tier->tier_points >= $this->loyalty_points) {
                    return $tier;
                }
                $prev = $tier;
                continue;
            }

            if ($next == null) {
                if ($this->loyalty_points > $prev->tier_points && $this->loyalty_points <= $tier->tier_points) {
                    return $tier;
                }
                $prev = $tier;
                $next = true;

                continue;
            }

            return $tier;
        }
    }

    public function getMembershipAttribute()
    {
        $tier = $this->tier;

        return $tier->membership()->first();
    }
    
    public function order(){
        
        return $this->hasMany(Order::class);
    }
    
    public function getProfileImageAttribute($value)
    {
        return asset('storage/' . $value);
    }
    
      public function getCoverPhotoAttribute($value)
    {
        return asset('storage/' . $value);
    }
    
    public function favorites()
    {
        return $this->hasMany(Favorite::class,'user_id');
    }
    
    public function cart()
    {
        return $this->hasMany(Cart::class,'user_id');
    }
    
    public function promotionalorder()
    {
        return $this->hasMany(PromotionalOrder::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
