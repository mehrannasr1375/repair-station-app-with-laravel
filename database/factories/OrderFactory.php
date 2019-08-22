<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
            'customer_id' => factory(App\Customer::class)->create(),
            'device_type' => 'لپتاپ',
            'device_brand' => 'hp',
            'device_model' => 'youga-310',
            'device_serial' => Str::random(12),
            'receive_date' => now(),
            'delivery_date' => '',
            'status_code' => Str::random(10),
            'problem' => 'روشن نمی شود',
            'problem_details' => '',
            'repair_info' => '',
            'delivery_note' => '',
            'opened_earlier' => false,
            'discount_amount' => 0,
            'checkout' => false,
            'participants_csv' => ''
    ];
});
