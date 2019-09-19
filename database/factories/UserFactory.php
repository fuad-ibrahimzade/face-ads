<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
//    bcrypt('password')=='$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
//    'profile_image' => 'temp.jpg',
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password: password
        'remember_token' => Str::random(10),


        'activity' => $faker->sentence(5),
        'sector' => $faker->randomElement(array(array('asector','bsector','csector'),array('asector','bsector'),array('csector'))),
        'pricing' => $faker->randomElement(array(['100', '200', '250'],['400','800'],['100','200','400','800'])),
        'city' => $faker->city,
        'customer_type' => $faker->randomElement(array('Entrepreneur','Freelancer','Agency')),
    ];
});
//$table->string('profile_image')->nullable();

$factory->state(User::class, 'Entrepreneur', function() {
    return [
        'customer_type' => 'Entrepreneur',
    ];
});
$factory->state(User::class, 'Freelancer', function() {
    return [
        'customer_type' => 'Freelancer',
    ];
});
$factory->state(User::class, 'Agency', function() {
    return [
        'customer_type' => 'Agency',
    ];
});
