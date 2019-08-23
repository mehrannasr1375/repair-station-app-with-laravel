<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public $timestamps = false;
    protected $guarded = [];
    protected $attributes = [
        'checkout' => false,
        'opened_earlier' => false,
        'status_code' => 0,
    ];



    public function customer() {
        return $this->belongsTo(\App\Customer::class);
    }
    public function orderDetails() {
        return $this->hasMany(\App\OrderDetails::class);
    }
    public function payments() {
        return $this->hasMany(\App\Payments::class);
    }
    public function messages() {
        return $this->hasMany(\App\Message::class);
    }



    public function getOpenedEarlierAttribute($attribute) {
        return [false=>'No', true=>'Yes'][$attribute];
    }
    public function getCheckoutAttribute($attribute) {
        return [false=>'No', true=>'Yes'][$attribute];
    }
    public function getStatusCodeAttribute($attribute) {
        return $this->getStatusesArray()[$attribute];
    }
    public function getStatusesArray() {
        return [
            0 => 'در حال تعمیر',
            1 => 'تعمیر شده',
            2 => 'تعمیر نمی شود',
            3 => 'ایراد ندارد',
            4 => 'انصراف مشتری'
        ];
    }


}
