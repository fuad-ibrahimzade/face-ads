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
        $link_click_count=count(CustomAnalyticsInfo::where('analytics_type','link_click')->get());
        return view('admin.dashboard')->with('link_click_count',$link_click_count);
    }
}
