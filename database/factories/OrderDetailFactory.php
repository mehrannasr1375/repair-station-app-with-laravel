<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\OrderDetail;
use Faker\Generator as Faker;

$factory->define(OrderDetail::class, function (Faker $faker) {
    return [
            'order_id' => factory(App\Order::class)->create(),
            'key' => 'هزینه تست',
            'amount' => 15000,
            'info' => 'اطلاعات  اضافی'
    ];
});
