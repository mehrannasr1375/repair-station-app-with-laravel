<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    public $timestamps = false;
    protected $guarded = [];
    protected $attributes = [
    ];
    
    
    
    public function order() {
        return $this->belongsTo(\App\Order::class);
    }

}
