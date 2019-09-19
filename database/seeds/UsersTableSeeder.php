<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
//    const filestack_handler_agency_profile='AJRkJtVBR7qpgIRC1Ff2';
//    const filestack_handler_freelancer_profile='3m99mKSGRLaoU4yMQ3ln';
//    const filestack_handler_entrepreneur_profile='wUfnrICRjWzrkFCzPQBC';
//    const filestack_handler_business_mark_profile='b6TJzC9EQy0l4SOdHl6Q';
    const filestack_handler_agency_profile='https://cdn.filestackcontent.com/AJRkJtVBR7qpgIRC1Ff2';
    const filestack_handler_freelancer_profile='https://cdn.filestackcontent.com/3m99mKSGRLaoU4yMQ3ln';
    const filestack_handler_entrepreneur_profile='https://cdn.filestackcontent.com/wUfnrICRjWzrkFCzPQBC';
    const filestack_handler_business_mark_profile='https://cdn.filestackcontent.com/b6TJzC9EQy0l4SOdHl6Q';
    public static function isDefaultFileStackUrl($stringToCheck)
    {
        return ( ($stringToCheck === UsersTableSeeder::filestack_handler_agency_profile) ||
            ($stringToCheck === UsersTableSeeder::filestack_handler_freelancer_profile) ||
            ($stringToCheck === UsersTableSeeder::filestack_handler_entrepreneur_profile) ||
            ($stringToCheck === UsersTableSeeder::filestack_handler_business_mark_profile) );
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = factory(User::class, 50)->create();


        $users->each(function ($user) {
        // Seed the relation with one address
//            $address = factory(App\CustomerAddress::class)->make();
//            $customer->address()->save($address);
//            // Seed the relation with 5 purchases
//            $purchases = factory(App\CustomerPurchase::class, 5)->make();
//            $customer->purchases()->saveMany($purchases);
//            $profile_image= $user->customer_type=='Entrepreneur' ? 'entrepreneur_profile.jpg': ($user->customer_type=='Agency' ? 'agency_profile.jpg': 'freelancer_profile.jpg');
            $profile_image= $user->customer_type=='Entrepreneur' ? UsersTableSeeder::filestack_handler_entrepreneur_profile : ($user->customer_type=='Agency' ? UsersTableSeeder::filestack_handler_agency_profile : UsersTableSeeder::filestack_handler_freelancer_profile);
            $user->profile_image=$profile_image;
//            $user->profile_image='https://picsum.photos/200/300';
            $user->verified=1;

            if(isset($user->sector)){
                foreach ($user->sector as $sector){
                    $sector_found=\App\Sector::where('sector',$sector)->first();
                    if(!$sector_found){
                        $sector_create= \App\Sector::create([
                            'email' => $user->email,
                            'sector' => $sector
                        ]);
                    }
                }
            }

            $user->save();
            if($user->customer_type=='Entrepreneur'){
                $businessMarks = factory(App\BusinessMark::class, 5)->make();
                $user->businessMarks()->saveMany($businessMarks);
//                $businessMarks=factory(\App\BusinessMark::class, 5)->create();
                $businessMarks->each(function ($businessMark){
//                    $randomSMMProviderUserEmail=User::whereNotIn('customer_type','Entrepreneur')->random()->email;
//                    $randomSMMProviderUser=User::whereNotIn('customer_type','Entrepreneur')->random();
//                    $businessMark->email = ->email;
                    $smmmservices = factory(\App\SMMService::class, 5)->create(
                        ['business_mark_id'=>$businessMark->id,'business_mark_name'=>$businessMark->name]);
                    $smmmservices->each(function ($smmmservice){
                        $randomEntrepreneur=User::whereNotIn('customer_type',['Entrepreneur'])->inRandomOrder()->first();
                        $smmmservice->email=$randomEntrepreneur->email;
                        $smmmservice->save();
                    });
//                    $smmmservices = rand ( 0 , User::whereNotIn('customer_type',['Entrepreneur'])->get()->count());

//                    inRandomOrder()
//                    User::orderByRaw("RAND()")->get();
//                    Laravel 4.0 - 4.2.6:
//
//                    User::orderBy(DB::raw('RAND()'))->get();
//                    Laravel 3:
//
//                    User::order_by(DB::raw('RAND()'))->get();

//                    $smmmservices->each(function (&$businessMark,$smmmservice){
//                        if($smmmservice->business_mark_id==$businessMark->business_mark_id){
//                            $smmmservice->id;
//                        }
//                    });
//                    $a=User::whereNotIn('customer_type',['Entrepreneur'])->random();
//                    $businessMark->smmservices()->saveMany($smmmservices);
//                    $smmmservices->each(function ($smmmservice){
////                        $smmmservice->email=User::whereNotIn('customer_type',['Entrepreneur'])->random()->email;
////                        $smmmservice->save();
//                        $usertemp=User::whereNotIn('customer_type',['Entrepreneur'])->random();
//                        $usertemp->smmservices()->save($smmmservice);
////                        User::whereNotIn('customer_type',['Entrepreneur'])->random()->save($smmmservice);
//                    });
//                    $businessMark->smmservices()->saveMany($smmmservices);
                });
//                $businessMarks=factory(App\BusinessMark::class, 5)->create(['email'=>$user->email]);

            }
        });

//        buda yuxaridakida ishliyir
//        factory(User::class, 10)->create()->each(function ($user) {
//            //create 5 posts for each user
//            if($user->customer_type=='Entrepreneur') {
//                factory(\App\BusinessMark::class, 5)->create(['email' => $user->email]);
//            }
//        });

//        eger butun seederleri burdan elesem bu ya yuxaridaki
//        factory(App\User::class, 50)->create();
//        /* or you can add also another table that is dependent on user_id:*/
//        /*factory(App\User::class, 50)->create()->each(function($u) {
//             $userId = $u->id;
//             DB::table('posts')->insert([
//                 'body' => str_random(100),
//                 'user_id' => $userId,
//             ]);
//         });*/
    }
}
