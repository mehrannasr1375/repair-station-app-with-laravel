<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $guarded = [];
    protected $attributes = [
        'is_partner' => false,
    ];

    
    public function orders() {
        return $this->hasMany(\App\Order::class);
    }

}
