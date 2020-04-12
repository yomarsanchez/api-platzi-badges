<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Badge;
use Faker\Generator as Faker;

$factory->define(Badge::class, function (Faker $faker) {
    $firstName = $faker->firstName;
    $lastName = $faker->lastName;
    $email = $faker->email;

    return [
        'first_name' => $firstName,
        'last_name' => $lastName,
        'email' => $email,
        'job_title' => $faker->jobTitle,
        'twitter' => strtolower($firstName . $lastName),
        'avatar_url' => \App\Helpers\Helper::getAvatar(null, $email),
        'state' => 1
    ];
});
