<?php

namespace App\Http\Controllers;

use App\SMMService;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Filestack\FilestackClient;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class SMMServiceController extends Controller
{

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('right_user_made_login')->only(['show_smm_work_form','create_smm_service','update_smm_service','delete_smm_service']);
    }

    public function show_smmservice_work_analyse($email,$id)
    {
        $smmmservice_work=SMMService::distinct()->where(['business_mark_id'=>$id,'email'=>$email])->get();
        return json_encode(array('smmmservice_work'=>$smmmservice_work));
    }

    protected function getService(Request $request)
    {
        $service=Auth::user()->smmservices->where('pricing',$request->selected_packet_price)->first();
        return $service;
    }
    protected function setService(Request $request)
    {
        $service=Auth::user()->smmservices->where('pricing',$request->selected_packet_price)->first();
        return json_encode(['services_for_price'=>$service->services_for_price]);
    }

    public function get_services_profile($email)
    {
        $asasas=0;
        $smmservices=Auth::user()->smmservices;
        return view('smmservices.mysmmservices',compact('smmservices',$smmservices));
    }

    public function get_ServiceProvidersForEntrepreneur(Request $request)
    {
        $sector=$request->sector;
        $price_min=$request->price_min;
        $price_max=$request->price_max;
        $city=$request->city;

        $smmservice_provider_users=User::has('smmservices')->get();
        $filtered_collection = $smmservice_provider_users->filter(function ($smmservice_provider_user) use(&$price_min,&$price_max,&$sector,&$city) {
            $minPriceCorresponds=false;
            $maxPriceCorresponds=false;
            $sectorCorresponds=false;
            $cityCorresponds=false;
            foreach ($smmservice_provider_user->pricing as $pricing){
                if($pricing>=$price_min && $pricing<=$price_max){
                    $minPriceCorresponds=true;
                }
            }
            if(isset($smmservice_provider_user->pricing2)){
                foreach ($smmservice_provider_user->pricing2 as $pricing2){
                    if($pricing2>=$price_min && $pricing2<=$price_max){
                        $minPriceCorresponds=true;
                    }
                }
            }
            if(isset($smmservice_provider_user->pricing3)){
                foreach ($smmservice_provider_user->pricing3 as $pricing3){
                    if($pricing3>=$price_min && $pricing3<=$price_max){
                        $minPriceCorresponds=true;
                    }
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
        });
        if($request->ajax()){
            return json_encode(['smmservice_provider_users'=>$filtered_collection]);
        }
        return redirect('/profile/'.Auth::user()->email)->with(['smmservice_provider_users'=>$filtered_collection])->withInput();
    }

    public function get_WorksOfServiceProvider(Request $request)
    {
        $smmservices=Auth::user()->smmservices()->with('businessMark')->get();
        if($request->ajax()){
            return json_encode(['smm_works'=>$smmservices]);
        }
        return view('smmservices.mysmmservices',compact('smm_works',$smmservices));
    }

    public  function show_smm_work_form(Request $request){
        return view('smmservices.smmserviceform');
    }
    public function create_smm_service(Request $request)
    {
        $customMessages = [
            'name.required' => 'ad daxil edilməlidir',

            'activity.required' => 'aktivlik barədə yazılmalıdır',
            'sector.required' => 'aidiyyatı sektor seçilməlidir',
            'city.required' => 'şəhər seçilməlidir',
            'profile_image.required' => 'profil şəkili seçilməlidir',
            'profile_image.mimes' => 'fayl şəkil tipi olmalidir',
            'profile_image.max' => 'şəkilin ölçüsü uyğun deyil',
            'profile_image.uploaded' => 'şəkilin ölçüsü uyğun deyil',

            'name.regex' => 'adı düzgün formada daxil edin',

            'pricing.required'   => 'ödəmə məbləği daxil edilməlidir',
            'work_start.required'   => 'işin başladığı zaman daxil edilməlidir',
        ];

//        /^[a-zA-Z][a-zA-Z0-9.,$;]+$/      first letter then alpha numeric
//        /^[a-z ,.'-]+$/i                  alfa spaceli
//        /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/   hamsini goturen kasha email
        $validate = \Validator::make($request->all(), [

            'name' 		=> 'required|string|regex:/^[a-zA-Z][a-zA-Z0-9üÜöÖəƏğĞçÇşŞ ,.\'-]+$/i',

            'profile_image' => 'required|mimes:jpeg,png,jpg,gif,svg',

            'activity' 		=> 'required',

            'sector' 		=> 'required',

            'city' 		=> 'required',

            'work_start'    => 'required',

        ], $customMessages);

        if(!$_FILES["profile_image"]["tmp_name"]){
            return redirect()
                ->back()
                ->withErrors(['şəkil seçilməyib'])->withInput();
        }

        if( $validate->fails()){

            return redirect()

                ->back()

                ->withErrors($validate)->withInput();

        }

        $cloudnaryFile=\Cloudinary\Uploader::upload($_FILES["profile_image"]["tmp_name"]);
        $avatarName=cloudinary_url($cloudnaryFile['public_id']);


        $business_mark_create = \App\BusinessMark::create([

            'email'      => 'NO EMAIL',

            'name'       => $request->name,

            'profile_image' => $avatarName,

            'activity' 		=> $request->activity,

            'sector' 		=> $request->sector,

            'city' 		=> $request->city,

        ]);

        $smm_create = \App\SMMService::create([

            'email'      => Auth::user()->email,

            'pricing' 		=> $request->pricing,

            'work_start' 		=> $request->work_start,

            'work_end'  => isset($request->work_end)?$request->work_end:'',

            'business_mark_id'  =>  $business_mark_create->id,

        ]);

        return redirect('profile/'.Auth::user()->email);
    }
    public function update_smm_service(Request $request)
    {
        $id=$request->route()->parameter('id');
        $smmService=\App\SMMService::with('businessMark')->where('id',$id)->first();
        if ($request->isMethod('GET'))
        {
            return view('smmservices.smmserviceUpdate',['smmService' => $smmService]);
        }
        if ($request->isMethod('POST'))
        {
            $customMessages = [
                'name.required' => 'ad daxil edilməlidir',

                'activity.required' => 'aktivlik barədə yazılmalıdır',
                'sector.required' => 'aidiyyatı sektor seçilməlidir',
                'city.required' => 'şəhər seçilməlidir',
                'profile_image.required' => 'profil şəkili seçilməlidir',
                'profile_image.mimes' => 'fayl şəkil tipi olmalidir',
                'profile_image.max' => 'şəkilin ölçüsü uyğun deyil',
                'profile_image.uploaded' => 'şəkilin ölçüsü uyğun deyil',

                'name.regex' => 'adı düzgün formada daxil edin',

                'pricing.required'   => 'ödəmə məbləği daxil edilməlidir',
                'work_start.required'   => 'işin başladığı zaman daxil edilməlidir',
            ];

//        /^[a-zA-Z][a-zA-Z0-9.,$;]+$/      first letter then alpha numeric
//        /^[a-z ,.'-]+$/i                  alfa spaceli
//        /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/   hamsini goturen kasha email
            $validate = \Validator::make($request->all(), [

                'name' 		=> 'required|string|regex:/^[a-zA-Z][a-zA-Z0-9üÜöÖəƏğĞçÇşŞ ,.\'-]+$/i',

                'profile_image' => 'sometimes|mimes:jpeg,png,jpg,gif,svg',

                'activity' 		=> 'required',

                'sector' 		=> 'required',

                'city' 		=> 'required',

                'work_start'    => 'required',

            ], $customMessages);
            if( $validate->fails()){
                return redirect()->back()->withErrors($validate)->withInput();
            }
            $businessMark=$smmService->businessMark();
            $smmService->businessMark->name= isset($request->name) ? $request->name : $smmService->businessMark->name;
            $smmService->businessMark->activity= isset($request->activity) ? $request->activity : $smmService->businessMark->activity;
            $smmService->businessMark->sector= isset($request->sector) ? $request->sector : $smmService->businessMark->sector;
            $smmService->businessMark->city= isset($request->city) ? $request->city : $smmService->businessMark->city;


            $smmService->work_start= isset($request->work_start) ? $request->work_start : $smmService->work_start;
            $smmService->work_end= isset($request->work_end) ? $request->work_end : $smmService->work_end;

            if($request->hasFile('profile_image')){

                if(!(\UsersTableSeeder::isDefaultFileStackUrl($smmService->businessMark->profile_image))){
                    $public_idOLD=str_replace('http://res.cloudinary.com/deov4g3ku/image/upload/','',$smmService->businessMark->profile_image);
                    $delete=\Cloudinary\Uploader::destroy($public_idOLD);
                }
                $cloudnaryFile=\Cloudinary\Uploader::upload($_FILES["profile_image"]["tmp_name"]);
                $avatarName=cloudinary_url($cloudnaryFile['public_id']);

                $smmService->businessMark->profile_image=$avatarName;
            }
            $smmService->push();
            return redirect('profile/'.Auth::user()->email);
        }
    }
    public function delete_smm_service(Request $request)
    {
        $id=$request->route()->parameter('id');
        if(\App\SMMService::with('businessMark')->where('id',$id)->where('email',\auth()->user()->email)->first()->businessMark->email=='NO EMAIL'){
            $profile_image=\App\SMMService::with('businessMark')->where('id',$id)->where('email',\auth()->user()->email)->first()->businessMark->profile_image;
            $public_idOLD=str_replace('http://res.cloudinary.com/deov4g3ku/image/upload/','',$profile_image);
            $delete=\Cloudinary\Uploader::destroy($public_idOLD);

            $smmServiceBusinessMark=\App\SMMService::with('businessMark')->where('id',$id)->where('email',\auth()->user()->email)->first()->businessMark->delete();
        }

        $smmService=\App\SMMService::where('id',$id)->where('email',\auth()->user()->email)->delete();;
        return redirect('profile/'.Auth::user()->email);
    }

}
