<?php

namespace App\Http\Controllers;

use App\CustomAnalyticsInfo;
use App\Mail\ContactsMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        if ($request->isMethod('GET')){
            return view('contact');
        }
        else if ($request->isMethod('POST')){
            $contact_name=$request->contact_name;
            $contact_email=$request->contact_email;
            $contact_message=$request->contact_message;
            $message_data=array('name'=>$contact_name,'email'=>$contact_email,'message'=>$contact_message);
            $emailSendTo=getenv('contacts_receiver_email');
            Mail::to($emailSendTo)->send(new ContactsMail($message_data));

            return redirect('contact')->with('success','emailınız uğurla göndərildi');
        }
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
        $http_referer=$request->server('HTTP_REFERER');
        $visited_page_link=0;
        $user_ip=$request->getClientIp();
        $locationInfoJson=CustomAnalyticsInfo::get_location();

        if(isset($locationInfoJson) && isset($locationInfoJson->country)){
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
        }

        return view('faceads');

    }
}
