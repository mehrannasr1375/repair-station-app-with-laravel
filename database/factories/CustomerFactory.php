<?php

use App\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'created_at' => now(),
        'is_partner' => 1 ,
        'mobile_1' => $faker->phoneNumber,
        'tell_1' => $faker->phoneNumber,
        'address' => $faker->address,
    ];
});
