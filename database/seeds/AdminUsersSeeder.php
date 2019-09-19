<?php

use Illuminate\Database\Seeder;

class AdminUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
            'verified'=>1,
            'type'=>\App\User::ADMIN_TYPE,
        ]);


//        'activity' => $faker->sentence(5),
//        'sector' => $faker->randomElement(array(array('asector','bsector','csector'),array('asector','bsector'),array('csector'))),
//        'pricing' => $faker->randomElement(array(['100', '200', '250'],['400','800'],['100','200','400','800'])),
//        'city' => $faker->city,
//        'customer_type' => $faker->randomElement(array('Entrepreneur','Freelancer','Agency')),
    }
}
