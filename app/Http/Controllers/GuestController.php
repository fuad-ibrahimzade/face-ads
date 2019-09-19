<?php

namespace App\Http\Controllers;

use App\CustomAnalyticsInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest')->except('faceads_home');
    }
    public function faceads_home(Request $request)
    {
        if(\Auth::check()){
            if(\Auth::user()->isAdmin()){
                return redirect('admin');
            }
            return redirect('profile/'.Auth::user()->email);
        }
        return view('faceads');
    }
    public function about(Request $request)
    {
        return view('about');
    }
    public function SI(Request $request)
    {
        return view('SI');
    }
    public function rm(Request $request)
    {
        return view('rm');
    }
    public function rating(Request $request)
    {
        return view('rating');
    }
    public function contact(Request $request)
    {
        return view('contact');
    }
    public function agh(Request $request)
    {
        return view('agh');
    }
    public function MFEM(Request $request)
    {
        return view('MFEM');
    }
    public function agentlik(Request $request)
    {
        return view('agentlik');
    }

    public function brand1(Request $request)
    {
        return view('brand1');
    }
    public function agentlik1(Request $request)
    {
        return view('agentlik1');
    }
    public function freelancer1(Request $request)
    {
        return view('freelancer1');
    }
    public function pay_and_start_ClickCounter(Request $request)
    {
//        'last_login_at' => Carbon::now()->toDateTimeString(),
        $http_referer=$request->server('HTTP_REFERER');
//        $country
        $visited_page_link=0;
        $user_ip=$request->getClientIp();
        $locationInfoJson=CustomAnalyticsInfo::get_location();
//        if(isset($locationInfoJson->message)){
////            echo "<pre>";
////            print_r($locationInfoJson);
////            echo "</pre>";
//            echo $locationInfoJson->message;
//        }
//        else {
//            echo $locationInfoJson->ip;
//            echo '<br>';
//            echo $locationInfoJson->city;
//            echo '<br>';
//            echo $locationInfoJson->currency->code;
//        }
        if(isset($locationInfoJson) && isset($locationInfoJson->country)){
//            $ip=$locationInfoJson->query;
//            $city=$locationInfoJson->city;
//            $currency=$locationInfoJson->currency;
//            echo $ip;
//            echo '<br>';
//            echo $city;
//            echo '<br>';
//            echo $currency;
//            $custom_analitics_info = CustomAnalyticsInfo::create([
//                'visited_page_link' => $request->url(),
//                'user_ip' => $locationInfoJson->query,
//                'country' => $locationInfoJson->country,
//                'http_referer' => $request->server('HTTP_REFERER'),
//                'ip_data' => $locationInfoJson
//            ]);
            $analytics_data=['visited_page_link' => $request->url(),
                'user_ip' => $locationInfoJson->query,
                'country' => $locationInfoJson->country,
                'http_referer' => $request->server('HTTP_REFERER'),
                'ip_data' => $locationInfoJson
            ];
            $custom_analitics_info = CustomAnalyticsInfo::create([
                'analytics_type' => 'link_click',
                'analytics_data' => $analytics_data
            ]);
//            echo 'done';
//            exit;
        }
//        else{
//            echo "<pre>";
//            print_r($locationInfoJson);
//            echo "</pre>";
//            exit;
//        }
//        $custom_analitics_info = CustomAnalyticsInfo::all();
//        foreach ($custom_analitics_info as $info){
//            $ip_info= ($info->ip_data);
//            echo '<br>';
//            echo $ip_info['query'];
//        }

        return view('faceads');

//        [as] => AS57293 AG Telecom LTD.
//    [city] => Baku
//    [country] => Azerbaijan
//    [countryCode] => AZ
//    [currency] => AZN
//    [isp] => AG Telecom LTD.
//    [lat] => 40.4093
//    [lon] => 49.8671
//    [org] =>
//    [query] => 5.197.246.25
//    [region] => BA
//    [regionName] => Baku City
//    [status] => success
//    [timezone] => Asia/Baku
//    [zip] =>

//        ashagidaki ipgeolocation cindir ishdemir sora
//        [ip] => 5.197.246.25
//    [continent_code] => AS
//    [continent_name] => Asia
//    [country_code2] => AZ
//    [country_code3] => AZE
//    [country_name] => Azerbaijan
//    [country_capital] => Baku
//    [state_prov] => Baki
//    [district] => Narimanov
//    [city] => Baku
//    [zipcode] => AZ1052
//    [latitude] => 40.40930
//    [longitude] => 49.86710
//    [is_eu] =>
//    [calling_code] => +994
//    [country_tld] => .az
//    [languages] => az,ru,hy
//    [country_flag] => https://ipgeolocation.io/static/flags/az_64.png
//    [geoname_id] => 587084
//    [isp] => AG Telecom LTD.
//    [connection_type] => fttx
//    [organization] => AG Telecom LTD.
//    [currency] => stdClass Object
//    (
//        [code] => AZN
//    [name] => Azerbaijan Manat
//    [symbol] => ман
//        )
//
//    [time_zone] => stdClass Object
//    (
//        [name] => Asia/Baku
//    [offset] => 4
//            [current_time] => 2019-09-12 00:18:44.320+0400
//            [current_time_unix] => 1568233124.32
//            [is_dst] =>
//            [dst_savings] => 0
//        )
    }
}
