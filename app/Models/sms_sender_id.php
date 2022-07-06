<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class sms_sender_id extends Model
{
    use HasFactory;

    // protected $dateFormat = 'U';

    protected $casts = [
       'registered_networks' => "array"
    ];
}
