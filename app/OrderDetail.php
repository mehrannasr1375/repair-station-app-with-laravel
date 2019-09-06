<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{

    public $timestamps = false;
    protected $guarded = [];
    protected $attributes = [
    ];



    public function order() {
        return $this->belongsTo(\App\Order::class);
    }
































}
