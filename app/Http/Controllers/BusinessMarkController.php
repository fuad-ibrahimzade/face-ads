<?php

namespace App\Http\Controllers;

//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Filestack\FilestackClient;
use Filestack\FilestackSecurity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BusinessMarkController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('right_user_made_login');
    }

    public function show_business_mark_analyse($email,$id)
    {
        return json_encode(array('assofjulia'=>1212));
    }

    public function show_business_mark_form()
    {
        return view('businessmarks.businessMark');
    }

    public function create_business_mark(Request $request)
    {
        $customMessages = [
            'name.required' => 'ad daxil edilməlidir',
            'email.required' => 'email daxil edilməlidir',
            'activity.required' => 'aktivlik barədə yazılmalıdır',
            'sector.required' => 'aidiyyatı sektor seçilməlidir',
            'city.required' => 'şəhər seçilməlidir',
            'profile_image.required' => 'profil şəkili seçilməlidir',
            'profile_image.mimes' => 'fayl şəkil tipi olmalidir',
            'profile_image.max' => 'şəkilin ölçüsü uyğun deyil',
            'profile_image.uploaded' => 'şəkilin ölçüsü uyğun deyil',

            'name.regex' => 'adı düzgün formada daxil edin',
        ];

//        /^[a-zA-Z][a-zA-Z0-9.,$;]+$/      first letter then alpha numeric
//        /^[a-z ,.'-]+$/i                  alfa spaceli
//        /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/   hamsini goturen kasha email
        $validate = \Validator::make($request->all(), [

            'name' 		=> 'required|string|regex:/^[a-zA-Z][a-zA-Z0-9üÜöÖəƏğĞçÇşŞ ,.\'-]+$/i',

            'profile_image' => 'required|mimes:jpeg,png,jpg,gif,svg',

            'activity' 		=> 'required',

            'sector' 		=> 'required',

            'city' 		=> 'required'

        ], $customMessages);

        if( $validate->fails()){

            return redirect()

                ->back()

                ->withErrors($validate)->withInput();

        }

        if(!$_FILES["profile_image"]["tmp_name"]){
            return redirect()
                ->back()
                ->withErrors(['şəkil seçilməyib'])->withInput();
        }

        $cloudnaryFile=\Cloudinary\Uploader::upload($_FILES["profile_image"]["tmp_name"]);
        $avatarName=cloudinary_url($cloudnaryFile['public_id']);

        $customer_type= $request->is('afq*') ? 'Agency' : ($request->is('sahibkar*') ? 'Entrepreneur' : ( $request->is('freelancer*') ? 'Freelancer' : 'NULL TYPE') );

        $user_create = \App\BusinessMark::create([

            'email'      => Auth::user()->email,

            'name'       => $request->name,

            'profile_image' => $avatarName,

            'activity' 		=> $request->activity,

            'sector' 		=> $request->sector,

            'city' 		=> $request->city,

        ]);

        return redirect('profile/'.Auth::user()->email);
    }
    public function update_business_mark(Request $request)
    {
        $id=$request->route()->parameter('id');
        $businessMark=\App\BusinessMark::where('id',$id)->first();
        if ($request->isMethod('GET'))
        {
            return view('businessmarks.businessMarkUpdate',['businessMark' => $businessMark]);
        }
        if ($request->isMethod('POST'))
        {
            $customMessages = [
                'name.required' => 'ad daxil edilməlidir',
                'email.required' => 'email daxil edilməlidir',
                'activity.required' => 'aktivlik barədə yazılmalıdır',
                'sector.required' => 'aidiyyatı sektor seçilməlidir',
                'city.required' => 'şəhər seçilməlidir',
                'profile_image.required' => 'profil şəkili seçilməlidir',
                'profile_image.mimes' => 'fayl şəkil tipi olmalidir',
                'profile_image.max' => 'şəkilin ölçüsü uyğun deyil',
                'profile_image.uploaded' => 'şəkilin ölçüsü uyğun deyil',

                'name.regex' => 'adı düzgün formada daxil edin',
            ];
            $validate = \Validator::make($request->all(), [

                'name' 		=> 'required|string|regex:/^[a-zA-Z][a-zA-Z0-9üÜöÖəƏğĞçÇşŞ ,.\'-]+$/i',

                'profile_image' => 'sometimes|mimes:jpeg,png,jpg,gif,svg',

                'activity' 		=> 'required',

                'sector' 		=> 'required',

                'city' 		=> 'required'

            ], $customMessages);
            if( $validate->fails()){
                return redirect()->back()->withErrors($validate)->withInput();
            }
            $businessMark->name= isset($request->name) ? $request->name : $businessMark->name;
            $businessMark->activity= isset($request->activity) ? $request->activity : $businessMark->activity;
            $businessMark->sector= isset($request->sector) ? $request->sector : $businessMark->sector;
            $businessMark->pricing= isset($request->pricing) ? $request->pricing : $businessMark->pricing;
            $businessMark->city= isset($request->city) ? $request->city : $businessMark->city;

            if($request->hasFile('profile_image')){
                if(!(\UsersTableSeeder::isDefaultFileStackUrl($businessMark->profile_image))){
                    $public_idOLD=str_replace('http://res.cloudinary.com/deov4g3ku/image/upload/','',$businessMark->profile_image);
                    $delete=\Cloudinary\Uploader::destroy($public_idOLD);
                }
                $cloudnaryFile=\Cloudinary\Uploader::upload($_FILES["profile_image"]["tmp_name"]);
                $avatarName=cloudinary_url($cloudnaryFile['public_id']);

                $businessMark->profile_image=$avatarName;
            }
            $businessMark->update();
            return redirect('profile/'.Auth::user()->email);
        }
    }
    public function delete_business_mark(Request $request)
    {
        $id=$request->route()->parameter('id');

        $profile_image=\App\BusinessMark::where('id',$id)->first()->profile_image;
        $public_idOLD=str_replace('http://res.cloudinary.com/deov4g3ku/image/upload/','',$profile_image);
        $delete=\Cloudinary\Uploader::destroy($public_idOLD);

        $businessMark=\App\BusinessMark::where('id',$id)->delete();;
        return redirect('profile/'.Auth::user()->email);
    }
}
