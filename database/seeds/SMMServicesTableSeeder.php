<?php

use Illuminate\Database\Seeder;

class SMMServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = factory(\App\SMMService::class, 10)->create();


//        $users->each(function ($user) {
//            // Seed the relation with one address
////            $address = factory(App\CustomerAddress::class)->make();
////            $customer->address()->save($address);
////            // Seed the relation with 5 purchases
////            $purchases = factory(App\CustomerPurchase::class, 5)->make();
////            $customer->purchases()->saveMany($purchases);
//            if($user->customer_type=='Entrepreneur'){
//                $businessMarks = factory(App\BusinessMark::class, 5)->make();
//                $user->businessMarks()->saveMany($businessMarks);
////                $businessMarks=factory(\App\BusinessMark::class, 5)->create();
////                $businessMarks->each(function ($businessMark){
////                    $businessMark->email = $user->email;
////                });
////                $businessMarks=factory(App\BusinessMark::class, 5)->create(['email'=>$user->email]);
//
//            }
//        });
    }
}
