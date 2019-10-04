<?php

namespace App\Http\Controllers\Admin;

use App\CustomAnalyticsInfo;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
//        $link_click_count=count(CustomAnalyticsInfo::where('analytics_type','link_click')->get());
//        $link_clicks=CustomAnalyticsInfo::where('analytics_type','link_click')->get();
        $link_clicks_distict=CustomAnalyticsInfo::where('analytics_type','link_click')->select('analytics_data->user_ip')->distinct()->get();
//        $link_clicks_distict=$link_clicks_distict->unique();  ->distinct() olnadan yuxaridaki yene duzgun netice verir
//        $filtered_collection = $link_clicks_distict->filter(function ($link_click) use(&$price_min,&$price_max,&$sector,&$city) {
//            $uniqueIPCorresponds=false;
//
//            if($link_click->analytics_type=='link_click') {
//                $currentClickIP=$link_click->analytics_data->user_ip;
//                $currentClickHTTP_REFERRER=$link_click->analytics_data->user_ip;
//                $current_analytics_data=$link_click->http_referer;
//                $allSIMILARtoCURRENT = CustomAnalyticsInfo::whereRaw('JSON_CONTAINS(analytics_data, \'{$current_analytics_data}\')')->get();
//
//                foreach ($link_click->pricing as $pricing) {
////                $mincorSP = Post::whereRaw('JSON_CONTAINS(sites, \'{$site_id}\')')->get();
//                    if ($pricing >= $price_min && $pricing <= $price_max) {
//                        $uniqueIPCorresponds = true;
//                    }
//                }
//            }
//
//
//            if($uniqueIPCorresponds){
//                return true;
//            }
//            else
//            {
//                return false;
//            }
//        });


        return view('admin.dashboard')->with('link_click_count',count($link_clicks_distict));
    }
}
