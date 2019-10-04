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

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('right_user_made_login')->except(['profile_for_outsider']);

    }

    public function profile_for_outsider(Request $request)
    {
        $user = Auth::user();
        if($request->route()->hasParameter('email') && $user->email!=$request->route()->parameter('email')){
                $smmservice_provider_user=User::where('email',$request->email)->get();
                $smmservices_unique=SMMService::distinct()->where('email',$request->email)->get();
                return json_encode(['smmservice_provider_user'=>$smmservice_provider_user,'smmservices_unique'=>$smmservices_unique]);
        }
    }

    public function profile(Request $request)
    {
        $user = Auth::user();
        if($request->route()->hasParameter('email') && $user->email!=$request->route()->parameter('email')){
            if($request->ajax()){
                if(!isset($request->email)){
                    return response()->json(null, 403);
                }

                $smmservice_provider_user=User::where('email',$request->email)->get();
                print_r($smmservice_provider_user);
                return json_encode(['smmservice_provider_user'=>$smmservice_provider_user]);
            }
            return response('Unauthorized.', 401);//burda 401 yeni credntial uygun deyil
        }
        $viewToReturn= $user->customer_type=='Entrepreneur' ? 'entrepreneur_kabinet' : ($user->customer_type=='Agency' ? 'agency_kabinet' : 'freelancer_kabinet' );

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

//            'email'	 	=> 'required|email|max:255|regex:/^[a-zA-Z]([a-zA-Z0-9_\.\-\+])+\@([a-zA-Z]([a-zA-Z0-9\-])+\.)+[a-zA-Z]([a-zA-Z0-9]{2,4})+$/',
            $requirementsArray=[

                'name' 		=> 'required|string|regex:/^[a-zA-Z][a-zA-Z0-9üÜöÖəƏğĞçÇşŞ ,.\'-]+$/i',

                'email'	 	=> 'required|email|max:255',

                'password' 	=> 'nullable|confirmed|max:255',


                'profile_image' => 'sometimes|required|mimes:jpeg,png,jpg,gif,svg',

                'activity' 		=> 'required',

                'sector' 		=> 'required'



            ];
            if($user->customer_type!='Entrepreneur')$requirementsArray['pricing']='required';
            $validate = \Validator::make($request->all(), $requirementsArray, $customMessages);

            if( $validate->fails()){

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

            if(isset($request->email) && $request->email!=$userDB->email){
                $verifyUser = \App\VerifyUser::where('email', $userDB->email)->first();
                if(isset($verifyUser)){
                    $verifyUser->email=$request->email;
                    $verifyUser->update();
                }

                $businessMarks= \App\BusinessMark::where('email', $userDB->email)->get();
                if(isset($businessMarks)){
                    foreach ($businessMarks as $businessMark){
                        $businessMark->email=$request->email;
                        $businessMark->update();
                    }
                }
                $smmServices= \App\SMMService::where('email', $userDB->email)->get();
                if(isset($smmServices)) {
                    foreach ($smmServices as $smmService) {
                        $smmService->email = $request->email;
                        $smmService->update();
                    }
                }
            }

            $social_links=array();
            if(isset($request->social)){
                $social_links['Facebook']=$request->social[0];
                $social_links['Twitter']=$request->social[1];
                $social_links['Instagram']=$request->social[2];
                $social_links['Youtube']=$request->social[3];
                $social_links['Pinterest']=$request->social[4];
                $social_links['Whatsapp']=$request->social[5];
                $social_links['Yelp']=$request->social[6];
                $social_links['Skype']=$request->social[7];
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
            $userDB->social_links= isset($request->social) ? $social_links : $userDB->social_links;


            if($request->hasFile('profile_image')){
                if(!(\UsersTableSeeder::isDefaultFileStackUrl($user->profile_image))){

                    $public_idOLD=str_replace('http://res.cloudinary.com/deov4g3ku/image/upload/','',$user->profile_image);
                    $delete=\Cloudinary\Uploader::destroy($public_idOLD);
                }

                $cloudnaryFile=\Cloudinary\Uploader::upload($_FILES["profile_image"]["tmp_name"]);
                $avatarName=cloudinary_url($cloudnaryFile['public_id']);

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
