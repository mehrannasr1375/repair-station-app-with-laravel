<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Reminder;
use Faker\Generator as Faker;

$factory->define(Reminder::class, function (Faker $faker) {
    return [
        'title' => $faker->numberBetween(1,100),
            
    ];
});
