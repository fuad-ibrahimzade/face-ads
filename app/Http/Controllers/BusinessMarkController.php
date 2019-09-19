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
//    use AuthenticatesUsers;
//    protected $redirectTo = '/profile';
    //
    public function __construct()
    {
//        $this->middleware('guest')->except('logout');
        $this->middleware('auth');
//        $this->middleware('auth_entrepreneur');
        $this->middleware('right_user_made_login');
//        ->except(['show_business_mark_analyse'])
    }

    public function show_business_mark_analyse($email,$id)
    {
//        add($email);
        return json_encode(array('assofjulia'=>1212));
//        return view('businessmarks.businessMark');
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

            'name' 		=> 'required|string|regex:/^[a-zA-Z][a-zA-Z0-9 ,.\'-]+$/i',

            'profile_image' => 'required|mimes:jpeg,png,jpg,gif,svg',

            'activity' 		=> 'required',

            'sector' 		=> 'required',

            'city' 		=> 'required'

        ], $customMessages);
//        'password_confirmation' => 'required ',
//        |max:2048     profile_image-den

//        'customer_type' 		=> 'required'
//        'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        if( $validate->fails()){

//            $messages = $validate->messages();
//
//            foreach ($messages->all('<li>:message</li>') as $message)
//            {
//                echo $message;
//            }
//            exit;
            return redirect()

                ->back()

                ->withErrors($validate)->withInput();

        }

//        $avatarName = $request->name.'_avatar'.time().'.'.$request->profile_image->getClientOriginalExtension();
//
//        $request->profile_image->storeAs('public/avatars',$avatarName);

        $client = new FilestackClient('AcDOjh26RKicWlRgz3T6Xz');
        $filelink = $client->upload($_FILES["profile_image"]["tmp_name"]);
        $avatarName=$filelink->url();

//        ==============
//        $image = $request->file('profile_image');
//        $name = Str::slug($request->input('name')).'_'.time();
//        $folder = '/uploads/images/';
//        $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
////        $this->uploadOne($image, $folder, 'public', $name);
//        // Set user profile image path in database to filePath
//        $name = !is_null($name) ? $name : Str::random(25);
//        $file = $image->storeAs($folder, $name.'.'.$image->getClientOriginalExtension(), 'public');
////        $user->profile_image = $filePath;
//        $avatarName=$filePath;
//        ==============
        $customer_type= $request->is('afq*') ? 'Agency' : ($request->is('sahibkar*') ? 'Entrepreneur' : ( $request->is('freelancer*') ? 'Freelancer' : 'NULL TYPE') );

        $user_create = \App\BusinessMark::create([

            'email'      => Auth::user()->email,

            'name'       => $request->name,

            'profile_image' => $avatarName,

            'activity' 		=> $request->activity,

            'sector' 		=> $request->sector,

            'city' 		=> $request->city,

        ]);

//        if (\Auth::attempt([
//
//            'email' => $request->email,
//
//            'password' => $request->password])
//
//        ){
//
//            return redirect('/profile');
//
//        }
//        $this->send_mail('xasohawer@onemail1.com','Face-Ads Email Verification','By clicking on the following link, you are confirming your email address.
//             <a href="'.url('user/verify', $user_create->verifyUser->token).'">Confirm Email Address</a>');
//        Mail::to($user_create->email)->send(new VerifyMail($user_create));

//        return redirect('login')->with('success', 'Qeydiyyat uğurla keçdi. Verifikasiya üçün zəhmət olmasa emailınıza baxin.');

//        return view('businessMark');
        return redirect('profile/'.Auth::user()->email);
    }
    public function update_business_mark(Request $request)
    {
        $id=$request->route()->parameter('id');
        $businessMark=\App\BusinessMark::where('id',$id)->first();
        if ($request->isMethod('GET'))
        {
//            if($businessMark->id!=-1){
////                print(Auth::user())
//                print($businessMark->smmservices());
//                exit;
//            }
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

                'name' 		=> 'required|string|regex:/^[a-zA-Z][a-zA-Z0-9 ,.\'-]+$/i',

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
//                \File::delete('storage/avatars/'.$businessMark->profile_image);
//                $avatarName = $request->name.'_avatar'.time().'.'.$request->profile_image->getClientOriginalExtension();
//                $request->profile_image->storeAs('public/avatars',$avatarName);
//                $businessMark->profile_image=$avatarName;

                $appsecret='IC3COZTS5RAJRKVAPJU2DZY2JQ';
                $security = new FilestackSecurity($appsecret);
                $client = new FilestackClient('AcDOjh26RKicWlRgz3T6Xz', $security);
                if(!(\UsersTableSeeder::isDefaultFileStackUrl($businessMark->profile_image))){
                    $handleOLD=str_replace('https://cdn.filestackcontent.com/','',$businessMark->profile_image);
                    $client->delete($handleOLD);
                }
                $filelink = $client->upload($_FILES["profile_image"]["tmp_name"]);
                $avatarName=$filelink->url();
                $businessMark->profile_image=$avatarName;
            }
            $businessMark->update();
            return redirect('profile/'.Auth::user()->email);
        }
//        return view('businessMark');
    }
    public function delete_business_mark(Request $request)
    {
        $id=$request->route()->parameter('id');
        $businessMark=\App\BusinessMark::where('id',$id)->delete();;
        return redirect('profile/'.Auth::user()->email);
    }
}
