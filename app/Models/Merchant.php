<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Merchant extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'mobile', 'rating', 'company', 'status', 'first_name_ar', 'last_name_ar', 'company_ar'
    ];

    protected $hidden = ['password'];

    protected $casts = [
        'status'    =>  'boolean'
    ];

}
