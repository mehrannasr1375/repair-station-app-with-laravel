<?php

use App\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'created_at' => now(),
        'updated_at' => now(),
        'name' => $faker->name,
        'is_partner' => 0,
        'mobile_1' => $faker->phoneNumber,
        'mobile_2' => $faker->phoneNumber,
        'tell_1' => $faker->phoneNumber,
        'tell_2' => $faker->phoneNumber,
        'address' => $faker->address,
    ];
});