<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Merchant extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'mobile', 'rating', 'company', 'status', 'first_name_ar', 'last_name_ar', 'company_ar', 'logo_image'
    ];

    protected $hidden = ['password'];

    protected $casts = [
        'status'    =>  'boolean'
    ];

    public function getLogoImageAttribute($value)
    {
        if (Str::startsWith($value, 'http')) {
            return $value;
        }

        return asset('files/' . $value);
    }

}
