<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

//$factory->define(Model::class, function (Faker $faker) {
//    return [
//        //
//    ];
//});
$factory->define(\App\SMMService::class, function (Faker $faker) {
//    bcrypt('password')=='$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
//    'email' => User::whereNotIn('customer_type',['Entrepreneur'])->first()->email,
    return [
        'pricing' => $faker->randomElement(array('100', '200', '250')),
    ];
});
