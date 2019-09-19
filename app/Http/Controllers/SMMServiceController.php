<?php

namespace App\Http\Controllers;

use App\SMMService;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class SMMServiceController extends Controller
{
    //
//    use AuthenticatesUsersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('auth');
//        $this->middleware('auth kohne');
        $this->middleware('right_user_made_login')->except(['get_ServiceProvidersForEntrepreneur','show_smmservice_work_analyse']);
    }

    public function show_smmservice_work_analyse($email,$id)
    {
//        dd($email);
        $smmmservice_work=SMMService::distinct()->where(['business_mark_id'=>$id,'email'=>$email])->get();
//        print_r($smmmservice_work);
        return json_encode(array('smmmservice_work'=>$smmmservice_work));
//        return view('businessmarks.businessMark');
    }

    protected function getService(Request $request)
    {
//        $service = SMMService::where(['email'=>,])->first(); // Product is the model
        $service=Auth::user()->smmservices->where('pricing',$request->selected_packet_price)->first();
//        return json_encode(['services_for_price'=>$service->services_for_price]);
        return $service;
    }
    protected function setService(Request $request)
    {
//        $service = SMMService::where(['email'=>,])->first(); // Product is the model
        $service=Auth::user()->smmservices->where('pricing',$request->selected_packet_price)->first();
        return json_encode(['services_for_price'=>$service->services_for_price]);
    }

    public function get_services_profile($email)
    {
        $asasas=0;
        $smmservices=Auth::user()->smmservices;
//        dd($smmservices);
        return view('smmservices.mysmmservices',compact('smmservices',$smmservices));
    }

    public function get_ServiceProvidersForEntrepreneur(Request $request)
    {
        $sector=$request->sector;
        $price_min=$request->price_min;
        $price_max=$request->price_max;
        $city=$request->city;

//        $users = App\User::with(['posts' => function ($query) {
//            $query->where('title', 'like', '%first%');
//        }])->get();
//        $user = User::with('Profile')->where('status', 1)->whereHas('Profile', function($q){
//            $q->where('gender', 'Male');
//        })->get();
//        $invoices = Invoice::with(array('user' => function($query) {
//            $query->where('account_status', '=', 1);
//        }))->where('invoice_status', '=', 2)->get();

//        dd($price_max);

//        $smmservice_providers = User::whereHas('smmservices', function (Builder $query) {
////            $query->where('content', 'like', 'foo%');
////            print($query->get());
//            $query->exists();
//        })->get();
        $smmservice_provider_users=User::has('smmservices')->get();
//        $users = User::with('smmservices')->whereHas('smmservices', function ($query) {
//            $query->where('is_active', '=', true);
//        })->get();
//        whereBetween('price', [$min_price, $max_price])
//        $smmservice_providers=$smmservice_providers->whereBetween();
        $filtered_collection = $smmservice_provider_users->filter(function ($smmservice_provider_user) use(&$price_min,&$price_max,&$sector,&$city) {
            $minPriceCorresponds=false;
            $maxPriceCorresponds=false;
            $sectorCorresponds=false;
            $cityCorresponds=false;
            foreach ($smmservice_provider_user->pricing as $pricing){
//                $mincorSP = Post::whereRaw('JSON_CONTAINS(sites, \'{$site_id}\')')->get();
                if($pricing>=$price_min && $pricing<=$price_max){
                    $minPriceCorresponds=true;
                }
//                if($pricing<$price_max){
//                    $maxPriceCorresponds=true;
//                }
            }
            if(isset($smmservice_provider_user->pricing2)){
                foreach ($smmservice_provider_user->pricing2 as $pricing2){
                    if($pricing2>=$price_min && $pricing2<=$price_max){
                        $minPriceCorresponds=true;
                    }
//                    if($pricing2<$price_max){
//                        $maxPriceCorresponds=true;
//                    }
                }
            }
            if(isset($smmservice_provider_user->pricing3)){
                foreach ($smmservice_provider_user->pricing3 as $pricing3){
                    if($pricing3>=$price_min && $pricing3<=$price_max){
                        $minPriceCorresponds=true;
                    }
//                    if($pricing3<$price_max){
//                        $maxPriceCorresponds=true;
//                    }
                }
            }
            foreach ($smmservice_provider_user->sector as $sector_of_user){
                if($sector_of_user==$sector){
                    $sectorCorresponds=true;
                }
            }
            if($smmservice_provider_user->city==$city){
                $cityCorresponds=true;
            }
            if(($maxPriceCorresponds || $minPriceCorresponds) && $sectorCorresponds && $cityCorresponds){
                return true;
            }
            else
            {
                return false;
            }
//            return $item->isDog();
        });
//        ->values();

//        dd($filtered_collection);
//        return redirect()->intended();
//        return redirect()->back();
//        return redirect()->route('profile',['email'=>auth()->user()->email]);
//        withInput(Input::all());;
        if($request->ajax()){
//            ,'price_min'=>$price_min,'price_max'=>$price_max,'sector'=>$sector
            return json_encode(['smmservice_provider_users'=>$filtered_collection]);
        }
        return redirect('/profile/'.Auth::user()->email)->with(['smmservice_provider_users'=>$filtered_collection])->withInput();
    }


}
