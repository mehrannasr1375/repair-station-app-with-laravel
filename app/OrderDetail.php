<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{

    public $timestamps = false;
    protected $guarded = [];
    protected $attributes = [
        'user_amount' => 0,
        'shop_amount' => 0,
    ];



    /* Relations */
    public function order() {
        return $this->belongsTo(\App\Order::class);
    }
































}
