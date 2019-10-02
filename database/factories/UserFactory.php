<?php

use app\Model;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Generator as Faker;



$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => 'test',
        'email' => 'test@test.com',
        'email_verified_at' => now(),
        'password' => Hash::make('abcd1234'),
        'remember_token' => Str::random(10),
    ];
});
