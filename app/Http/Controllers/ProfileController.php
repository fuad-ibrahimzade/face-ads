<?php

namespace App\Http\Controllers;
//namespace App\Http\Controllers\Auth;

//use App\Http\Controllers\Controller;
use App\SMMService;
use App\User;
use Filestack\Filelink;
use Filestack\FilestackClient;
use Filestack\FilestackSecurity;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    //
//    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = '/profile';
//      yuxaridaki 2si avtomatik /profileye route edirdi

    public function __construct()
    {
//        $this->middleware('guest')->except('logout');
        $this->middleware('auth');
        $this->middleware('right_user_made_login')->except(['profile_for_outsider']);

    }

    public function profile_for_outsider(Request $request)
    {
        $user = Auth::user();
        if($request->route()->hasParameter('email') && $user->email!=$request->route()->parameter('email')){
//            return redirect()->back()->with()
//            if($request->ajax()){
//                if(!isset($request->email)){
////                    return response('Unauthorized.', 403);//burda 403 yeni umumiyyetnen uygun deyil
//                    return response()->json(null, 403);
//                }
                $smmservice_provider_user=User::where('email',$request->email)->get();
//            ->with('smmservices')
                $smmservices_unique=SMMService::distinct()->where('email',$request->email)->get();
//            if($smmservice_provider_user){
//                Session::put('smmservice_provider_user',$smmservice_provider_user);
//            }
//            return redirect()->back();
                return json_encode(['smmservice_provider_user'=>$smmservice_provider_user,'smmservices_unique'=>$smmservices_unique]);
//            }
//            return response('Unauthorized.', 401);//burda 401 yeni credntial uygun deyil
        }
    }

    public function profile(Request $request)
    {
        $user = Auth::user();
        if($request->route()->hasParameter('email') && $user->email!=$request->route()->parameter('email')){
//            return redirect()->back()->with()
            if($request->ajax()){
                if(!isset($request->email)){
//                    return response('Unauthorized.', 403);//burda 403 yeni umumiyyetnen uygun deyil
                    return response()->json(null, 403);
                }

                $smmservice_provider_user=User::where('email',$request->email)->get();
//            if($smmservice_provider_user){
//                Session::put('smmservice_provider_user',$smmservice_provider_user);
//            }
//            return redirect()->back();
                print_r($smmservice_provider_user);
                return json_encode(['smmservice_provider_user'=>$smmservice_provider_user]);
            }
            return response('Unauthorized.', 401);//burda 401 yeni credntial uygun deyil
        }
//        $profile_image=$user->profile_image;
//        dd( \App\Entrepreneur::find(1)->user->name);
//        $data=(\App\Entrepreneur::where('email',$user->email)->first()->user->email);
//        print_r($data);
//        return;

//        $entrepreneur_create = \App\Entrepreneur::create([
//
//            'email'     => 'pox@pox.com',
//            'rating_af'     => 1,
//            'budget_spent' => 200,
//            'started_work'      =>Date::now(),
//            'finished_work'     =>Date::tomorrow(),
//            'worker_email_af'      => 'pox@pox.com'
//        ]);
//        return;
//        dd($user->customer_type);
//        dd($user->smmservices);
//        $records = \DB::table('s_m_m_services')->get();
//        dd($records);
        $viewToReturn= $user->customer_type=='Entrepreneur' ? 'entrepreneur_kabinet' : ($user->customer_type=='Agency' ? 'agency_kabinet' : 'freelancer_kabinet' );
//        return view('fpages/profile',compact('user',$user));
//        return view('profile/'.$viewToReturn,compact('user',$user));

//        $smmservice_provider_users=User::has('smmservices')->get();
////        $data=['smmservice_provider_users'=>$smmservice_provider_users,'user'=>$user];
//        if(!Session::has('smmservice_provider_users')){
//            Session::put('smmservice_provider_users',$smmservice_provider_users);
//        }
//        ->with(['smmservice_provider_users'=>$smmservice_provider_users])

//        $handle='PKD0q9TFqrQGW6JaTNqA';
//        $filelink = new Filelink($handle, "AcDOjh26RKicWlRgz3T6Xz");
////        dd($filelink->handle);
//        $content = $filelink->getContent();
////        dd($content);
//        echo '<img src="'.$filelink->url().'">';
        return view('profile/'.$viewToReturn,compact('user',$user));
    }

    public function profile_edit(Request $request)
    {
        $user = Auth::user();
        if ($request->isMethod('GET')){
            $viewToReturn= $user->customer_type=='Entrepreneur' ? 'entrepreneur_edit' : ($user->customer_type=='Agency' ? 'agency_edit' : 'freelancer_edit' );
            return view('profile/'.$viewToReturn);
        }
        else if ($request->isMethod('POST')){

            $customMessages = [
                'name.required' => 'ad daxil edilməlidir',
                'email.required' => 'email daxil edilməlidir',
                'password.required' => 'şifrə daxil edilməlidir',
                'activity.required' => 'aktivlik barədə yazılmalıdır',
                'sector.required' => 'aidiyyatı sektor seçilməlidir',
                'city.required' => 'şəhər seçilməlidir',
                'profile_image.required' => 'profil şəkili seçilməlidir',
                'profile_image.mimes' => 'fayl şəkil tipi olmalidir',
                'profile_image.max' => 'şəkilin ölçüsü uyğun deyil',
                'profile_image.uploaded' => 'şəkilin ölçüsü uyğun deyil',
                'password.confirmed' => 'şifrənin təkrarı səhf daxil edilib',
                'pricing.required' => 'qiymət paketi daxil edin',
                'name.regex' => 'adı düzgün formada daxil edin',
                'email.email' => 'email düzgün formatda olmalıdır',
                'email.regex' => 'email düzgün formatda olmalıdır',
                'email.unique' =>  'email artıq istifadə olunur'
            ];

//            $validate = \Validator::make($request->all(), [
//
//                'name' 		=> 'required',
//
//                'email'	 	=> 'required|email|max:255',
//
//                'password' 	=> 'nullable|confirmed|max:255',
//
//                'profile_image' => 'sometimes|required|mimes:jpeg,png,jpg,gif,svg|max:2048',
//
//                'activity' 		=> 'required',
//
//                'sector' 		=> 'required',
//
//                'city' 		=> 'required'
//
//            ], $customMessages);
//            'email'	 	=> 'required|email|max:255|regex:/^[a-zA-Z]([a-zA-Z0-9_\.\-\+])+\@([a-zA-Z]([a-zA-Z0-9\-])+\.)+[a-zA-Z]([a-zA-Z0-9]{2,4})+$/',
            $requirementsArray=[

                'name' 		=> 'required|string|regex:/^[a-zA-Z][a-zA-Z0-9 ,.\'-]+$/i',

                'email'	 	=> 'required|email|max:255',

                'password' 	=> 'nullable|confirmed|max:255',


                'profile_image' => 'sometimes|required|mimes:jpeg,png,jpg,gif,svg',

                'activity' 		=> 'required',

                'sector' 		=> 'required',

                'city' 		=> 'required'

            ];
            if($user->customer_type!='Entrepreneur')$requirementsArray['pricing']='required';
            $validate = \Validator::make($request->all(), $requirementsArray, $customMessages);
//        'password_confirmation' => 'required ',
//            |exists:users     emaila aid
//            unique:users      emaila aid
//            nullable          profile_image aid
//            |max:2048     profile_image

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
                return redirect()->back()->withErrors($validate)->withInput();
            }

            $userDB = \App\User::where('email', $user->email)->first();
            $newUserInDB= \App\User::where('email', $request->email)->first();
            if(($newUserInDB) and $newUserInDB->name!=$userDB->name){
                return redirect()->back()->withErrors(['first' => 'Eyni adda digər bir istifadəçi artıq mövcuddur']);
            }

            $pricing1=null;
            $pricing2=null;
            $pricing3=null;
            if(isset($request->pricing)){
                $pricing1= array_map(
                    function($value) { return (int)$value; },
                    $request->pricing
                );
            }
            if(isset($request->pricing2)){
                $pricing2= array_map(
                    function($value) { return (int)$value; },
                    $request->pricing2
                );
            }
            if(isset($request->pricing3)){
                $pricing3= array_map(
                    function($value) { return (int)$value; },
                    $request->pricing3
                );
            }

            $userDB->email= isset($request->email) ? $request->email : $userDB->email;
            $userDB->name= isset($request->name) ? $request->name : $userDB->name;
            $userDB->activity= isset($request->activity) ? $request->activity : $userDB->activity;
            $userDB->sector= isset($request->sector) ? $request->sector : $userDB->sector;
            $userDB->pricing= isset($request->pricing) ? $pricing1 : $userDB->pricing;
            $userDB->pricing2= isset($request->pricing2) ? $pricing2 : null;
            $userDB->pricing3= isset($request->pricing3) ? $pricing3 : null;
            $userDB->city= isset($request->city) ? $request->city : $userDB->city;
            $userDB->password= isset($request->password) ? bcrypt($request->password) : $userDB->password;


            if($request->hasFile('profile_image')){
//                \File::delete('storage/avatars/'.$user->profile_image);
//                $avatarName = $request->name.'_avatar'.time().'.'.$request->profile_image->getClientOriginalExtension();
//                $request->profile_image->storeAs('public/avatars',$avatarName);
//                $security=  array(
//                    "expiry": 1523595600,
//                      "call": ["read", "convert"],
//                      "handle": "bfTNCigRLq0QMOrsFKzb"
//                )

                $appsecret='IC3COZTS5RAJRKVAPJU2DZY2JQ';
                $security = new FilestackSecurity($appsecret);
                $client = new FilestackClient('AcDOjh26RKicWlRgz3T6Xz', $security);
                if(!(\UsersTableSeeder::isDefaultFileStackUrl($user->profile_image))){
//                    dd($filelinkOLD);
//                    exit;
                    $handleOLD=str_replace('https://cdn.filestackcontent.com/','',$user->profile_image);
//                    $filelinkOLD = new Filelink($handleOLD, "AcDOjh26RKicWlRgz3T6Xz");
//                    dd($filelinkOLD);
                    $client->delete($handleOLD);
//                    $filelinkOLD->delete();
                }
                $filelink = $client->upload($_FILES["profile_image"]["tmp_name"]);

                $avatarName=$filelink->url();
                $userDB->profile_image=$avatarName;
            }
            $userDB->update();

            if(isset($request->sector)){
                foreach ($request->sector as $sector){
                    $sector_found=\App\Sector::where('sector',$sector)->first();
                    if(!$sector_found){
                        $sector_create= \App\Sector::create([
                            'email' => $request->email,
                            'sector' => $sector
                        ]);
                    }
                }
            }

            return redirect('profile/'.Auth::user()->email);
        }
    }


}
