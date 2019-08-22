<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
            'customer_id' => factory(App\Customer::class)->create(),
            'device_type' => $faker->randomElement($array = array ('مانیتور','کارت گرافیک','pc','لپتاپ','مودم')),
            'device_brand' => $faker->randomElement($array = array ('سامسونگ','hp','لنوو','وایو','nvidia','ایسوس')),
            'device_model' => randomElement($array = array ('h61-mp20','youga-310','k556-xl','gt-610')),
            'device_serial' => '',
            'receive_date' => now(),
            'delivery_date' => '',
            'status_code' => $faker->randomElement($array = array (1,2,3,4,5)),
            'problem' => $faker->randomElement($array = array ('شکسته است','روشن نمی شود','تصویر ندارد')),
            'problem_details' => '',
            'repair_info' => '',
            'delivery_note' => '',
            'opened_earlier' => $faker->randomElement($array = array (true,false)),
            'discount_amount' => 0,
            'checkout' => $faker->$faker->randomElement($array = array (true,false)),
            'participants_csv' => ''
    ];
});
