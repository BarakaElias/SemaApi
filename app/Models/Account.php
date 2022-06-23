<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;


    // public function apikeys(){
    //     return $this->hasMany(Apikey::class);
    // }
    protected $casts = [
        'api_secrets' => 'object',
    ];
}
