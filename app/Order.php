<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function customer() {
        return $this->belongsTo(\App\Customer::class);
    }

    public function orderDetails() {
        return $this->hasMany(\App\OrderDetails::class);
    }

    public function payments() {
        return $this->hasMany(\App\Payments::class);
    }

}
