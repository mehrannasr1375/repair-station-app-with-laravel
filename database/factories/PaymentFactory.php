<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Payment;
use Faker\Generator as Faker;

$factory->define(Payment::class, function (Faker $faker) {
    return [
            'order_id' => factory(App\Order::class)->create(),
            'amount' => 2000,
            'payment_type' => 'نقد',
            'date' =>  now()
    ];
});
