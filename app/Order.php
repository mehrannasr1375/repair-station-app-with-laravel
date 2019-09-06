<?php
/*
*  0 : repairing
*  1 : repaired
*  2 : not repairable
*  3 : no problem
*  4 : rejected by customer
*/
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



    /* Relations */
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



    /* Get Customized Attributes */
    public function getStatusCodeAttribute($attribute) {
        return $this->getStatusesArray()[$attribute];
    }



    /* Statuses Associative Array */
    public function getStatusesArray() {
        return [
            0 => 'در حال تعمیر',
            1 => 'تعمیر شده',
            2 => 'تعمیر نمی شود',
            3 => 'ایراد ندارد',
            4 => 'انصراف مشتری'
        ];
    }



    /* Scopes (محدوده ها) */
    public function scopeAllOrders($query)
    {
        return $query->where('status_code', '>=', 0);
    }
    public function scopePrepairedOrders($query)
    {
        return $query->where('status_code', '>=', 1);
    }
    public function scopeUndeliveredOrders($query)
    {
        return $query->where('checkout', false);
    }
    public function scopeRepairingOrders($query)
    {
        return $query->where('status_code', 0);
    }
    public function scopeOrderByDesc($query)
    {
        return $query->orderBy('id', 'desc');
    }





















}
