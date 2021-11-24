<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomPush extends Model
{
    protected $fillable = [
        'sent_to',
        'message',
        'sent_on',
        'status'
    ];

    protected $casts = [
        'status'    => 'boolean'
    ];
}
