<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\BusinessMark;
use App\User;
use Faker\Generator as Faker;

$factory->define(BusinessMark::class, function (Faker $faker) {
//    'email' => $faker->unique()->safeEmail,

//    'email' => factory(User::class)->states('Entrepreneur')->create()->email,
    return [
        'name' => $faker->name,
        'profile_image' => UsersTableSeeder::filestack_handler_business_mark_profile,

        'activity' => $faker->sentence(5),
        'sector' => ['asector','bsector','csector'],
        'pricing' => '100 AZN - 250 AZN',
        'city' => $faker->city,
    ];
});
