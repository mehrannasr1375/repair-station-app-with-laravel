<?php

use App\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'created_at' => now(),
        'is_partner' => 1 ,
        'mobile_1' => $faker->numberBetween(90000000,99999999),
        'tell_1' => $faker->numberBetween(1000000,9999999),
        'address' => $faker->address,
    ];
});
