<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;


class Apikey extends Model
{
    use HasFactory;


    public function account(){
        return $this->hasOne(Account::class);
    }
    protected $casts = [
        'api_secrets' => "array"
     ];
}
