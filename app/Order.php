<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function customer() {
        return $this->belongsTo(\App\Customer::class);
    }

}
