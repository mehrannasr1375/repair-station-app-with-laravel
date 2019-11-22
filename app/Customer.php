<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    public $timestamps = false;
    protected $guarded = [];
    protected $attributes = [
        'is_partner' => false,
    ];



    /* Relations */
    public function orders() {
        return $this->hasMany(\App\Order::class);
    }



     /* Scopes (محدوده ها) */
     public function scopeAllCustomers($query)
     {
         return $query->where('id', '>', 0);
     }



}
