<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';
    
    protected $fillable = ['address','address_city','monto','phone_number','user_id'];
}
