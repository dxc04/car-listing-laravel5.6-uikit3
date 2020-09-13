<?php

use Faker\Generator as Faker;
use App\Car as Car;

$factory->define(App\Car::class, function (Faker $faker) {

    $faker->addProvider(new \Faker\Provider\Fakecar($faker));
    $make_model = Car::getDefaultMakeAndModel();
    $make = array_rand($make_model);

    return [
        'make'              => $make,
        'model'             => $faker->vehicleModel($make),
        'year'              => $faker->biasedNumberBetween(2000, 2020, 'sqrt'),
        'price'             => $faker->numberBetween(400000, 3000000),
        'body_type'         => $faker->vehicleType,
        'fuel_type'         => $faker->vehicleFuelType,
        'transmission'      => $faker->vehicleGearBoxType,
        'description'       => $faker->text(100)
    ];
});