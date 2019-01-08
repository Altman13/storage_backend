<?php

use Faker\Generator as Faker;


$factory->define(\App\Component::class, function (Faker $faker) {
    $deviceIds=\App\Device::all()->pluck('id')->toArray();
    return [
        'name'=>$faker->text(10),
        'device_iddevice'=>$faker->randomElement($deviceIds)
    ];
});
