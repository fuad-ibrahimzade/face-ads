<?php

namespace App\Http\Controllers;

use App\Mail\VerifyMail;
use Filestack\FilestackClient;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;

//use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /* GET

    */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function authenticated(Request $request, User $user)
    {
        return redirect()->intended();
    }

    public function register(Request $request)
    {
        if ($request->isMethod('POST'))
        {
            $this->registerUser($request);
        }
        if ($request->isMethod('GET'))
        {
//            echo $request->is('freelancer*') . ' aaaaa';
//            $this->registrationForm($request);
//            $request->route()->getName()
            if($request->is('freelancer*')){
                return view('freelancer');
            }
            else if($request->is('agency*')){
                return view('agency');
            }
            else if($request->is('brand*')){
                return view('sahibkar');
            }
//            if(view()->exists($request->route()->getName())){
//                return view($request->route()->getName());
//            }
//            echo $request->method();
////            exit;
        }
    }

    public function registrationForm(Request $request)
    {
//        echo $request->url();
//        return view('freelancer');
//        echo Route::current()->getName();

//        switch (Route::current()->getName()){
//            case 'freelancer':
//                return view('freelancer');
//            break;
//                case 'afq':
//                    return view('afq');
//            break;
//                case 'sahibkar':
//                    return view('sahibkar');
//        }
//        echo \Auth::check() . ' ale';
        if($request->is('register*')){
//            if(($request->has)
            return view('register');
        }
        if($request->is('freelancer*')){
//            if(($request->has)
            return view('freelancer');
        }
        else if($request->is('agency*')){
            return view('agency');
        }
        else if($request->is('brand*')){
            return view('sahibkar');
        }
//        if($request->is('sahibkar/*')){

//        return view('custom_auth.register');

    }

    /* POST

    */

    public function registerUser(Request $request)

    {
        $customer_type= $request->is('agency*') ? 'Agency' : ($request->is('brand*') ? 'Entrepreneur' : ( $request->is('freelancer*') ? 'Freelancer' : 'NULL TYPE') );

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

//        /^[a-zA-Z][a-zA-Z0-9.,$;]+$/      first letter then alpha numeric
//        /^[a-z ,.'-]+$/i                  alfa spaceli
//        /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/   hamsini goturen kasha email
//        'email'	 	=> 'required|email|unique:users|max:255|regex:/^[a-zA-Z]([a-zA-Z0-9_\.\-\+])+\@([a-zA-Z]([a-zA-Z0-9\-])+\.)+[a-zA-Z]([a-zA-Z0-9]{2,4})+$/',
        $requirementsArray=[

            'name' 		=> 'required|string|regex:/^[a-zA-Z][a-zA-Z0-9 ,.\'-]+$/i',

            'email'	 	=> 'required|email|unique:users|max:255',

            'password' 	=> 'nullable|confirmed|max:255',


            'profile_image' => 'sometimes|required|mimes:jpeg,png,jpg,gif,svg',

            'activity' 		=> 'required',

            'sector' 		=> 'required',

            'city' 		=> 'required'

        ];

        if($customer_type!='Entrepreneur')$requirementsArray['pricing']='required';
        $validate = \Validator::make($request->all(), $requirementsArray, $customMessages);
//        $validate = \Validator::make($request->all(), [
//
//            'name' 		=> 'required|string|regex:/^[a-zA-Z][a-zA-Z0-9 ,.\'-]+$/i',
//
//            'email'	 	=> 'required|email|unique:users|max:255|regex:/^[a-zA-Z]([a-zA-Z0-9_\.\-\+])+\@([a-zA-Z]([a-zA-Z0-9\-])+\.)+[a-zA-Z]([a-zA-Z0-9]{2,4})+$/',
//
//            'password' 	=> 'required|confirmed|max:255',
//
//
//            'profile_image' => 'required|mimes:jpeg,png,jpg,gif,svg',
//
//            'activity' 		=> 'required',
//
//            'sector' 		=> 'required',
//
//            'city' 		=> 'required',
//
//            'pricing'      => 'required'
//
//        ], $customMessages);
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

        $client = new FilestackClient('AcDOjh26RKicWlRgz3T6Xz');
        $filelink = $client->upload($_FILES["profile_image"]["tmp_name"]);
//        dd($filelink);
//        dd($filelink->handle);
//        $handle='PKD0q9TFqrQGW6JaTNqA';
//        $filename='"php5F91.tmp';
//
//
////        agency_profile.jpg            AJRkJtVBR7qpgIRC1Ff2
////        freelancer_profile.jpg        3m99mKSGRLaoU4yMQ3ln
////        entrepreneur_profile.jpg      wUfnrICRjWzrkFCzPQBC
////        business_mark_profile.jpg     b6TJzC9EQy0l4SOdHl6Q
//
//        $filelink = new Filelink($handle, "AcDOjh26RKicWlRgz3T6Xz");
//
//        $content = $filelink->getContent();


//        $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
//
//        $imageSRC='';
//        if($check !== false) {
//            $data = base64_encode(file_get_contents( $_FILES["profile_image"]["tmp_name"] ));
////            echo "copy + paste the data below, use it as a string in ur JavaScript Code<br><br>";
//            $imageSRC='data:'.$check["mime"].';base64,'.$data;
////            echo "<textarea id='data' style=''>data:".$check["mime"].";base64,".$data."</textarea>";
////            echo '<img src="'.$imageSRC.'"/>';
////            exit;
//        } else {bb@bb.com
//            echo "File is not an image.";
//        }



//        $avatarName = $request->name.'_avatar'.time().'.'.$request->profile_image->getClientOriginalExtension();
//
//        $request->profile_image->storeAs('public/avatars',$avatarName);
////        $avatarName=$imageSRC;
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
        $pricing1 = array_map(
            function($value) { return (int)$value; },
            $request->pricing
        );
        $pricing2=null;
        $pricing3=null;
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

        $user_create = \App\User::create([

            'password'   => bcrypt($request->password),

            'email'      => $request->email,

            'name'       => $request->name,

            'profile_image' => $avatarName,

            'activity' 		=> $request->activity,

            'sector' 		=> $request->sector,

            'pricing'    =>  $pricing1,

            'pricing2'    =>  isset($request->pricing2) ? $pricing2 : null,

            'pricing3'    =>  isset($request->pricing3) ? $pricing3 : null,

            'city' 		=> $request->city,

            'customer_type' 		=> $customer_type,

            'type' => \App\User::DEFAULT_TYPE

        ]);
//        'street'        => 'streetstreetstreetstreet',

        $verifyUser = \App\VerifyUser::create([
            'email' => $request->email,
            'token' => Str::random(40)
        ]);

        foreach ($request->sector as $sector){
            $sector_found=\App\Sector::where('sector',$sector)->first();
            if(!$sector_found){
                $sector_create= \App\Sector::create([
                    'email' => $request->email,
                    'sector' => $sector
                ]);
            }
        }

        $entrepreneur_create = \App\Entrepreneur::create([

            'email'     => $request->email,
            'rating_af'     => 1,
            'budget_spent' => 200,
            'started_work'      =>Date::now(),
            'finished_work'     =>Date::tomorrow(),
            'worker_email_af'      => $request->email
        ]);

//        $smmservice_create=  \App\SMMService::create([
//
//            'email'     => $request->email,
//            'services_for_price'     => $request->activity,
//            'pricing' => $request->pricing
//        ]);

        //customer-type yeni ya sahibkar ya freelancer ya agentlik yeni ya S ya F ya A

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
        Mail::to($user_create->email)->send(new VerifyMail($user_create));

        return redirect('login')->with('success', 'Qeydiyyat uğurla keçdi. Verifikasiya üçün zəhmət olmasa emailınıza baxin.');

    }

    public function verifyUser($token){
//        dd($token);
        $verifyUser = \App\VerifyUser::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->verified) {
                $verifyUser->user->verified = 1;
                $verifyUser->user->save();
                $status = "Emailınız verifikasiya oldu. Daxil ola bilərsiniz.";
            }else{
                $status = "Emailınız bundan oncə verifikasiya olub. Daxil ola bilərsiniz.";
            }
        }else{
            return redirect('/login')->with('error', "Bağışlayın sistem linki tanimadı");
        }

        return redirect('/login')->with('warning', $status);
    }

    public function sendVerifyEmail($email){
//        dd($email);
        $user = \App\User::where('email', $email)->first();
        $verifyuser = \App\VerifyUser::where('email', $email)->first();
        if(isset($user) ) {
//            $token= Str::random(40);
//            $user->verifyUser->token=$token;

//            $verifyuser->token=$token;
//            $verifyuser->update();
//            $user->save();
//            $user->verifyUser->save();

//            $user->push();
            Mail::to($email)->send(new VerifyMail($user));
        }
        else{
            return redirect('/login')->with('warning', 'yeni verivikasiya emailı göndərilmədi. zəjmət olmasa yenidən qeydiyyatdan keçin.');
        }
        return redirect('/login')->with('warning', 'yeni verivikasiya emailı göndərildi');
    }

//    public function profile(Request $request)
//    {
//
////        echo 'PROFILE' . Auth::check();
////        $user = auth kohne()->user();
////        $profile_image=$user->profile_image;
////        return view('profile');
//        return redirect('/profile');
//    }

    public function showLoginForm()

    {
//        4e5fed707ad79b48267aa3e73efa00e1-us3
//        $this->send_mail('xasohawer@onemail1.com','Face-Ads Email Verification','By clicking on the following link, you are confirming your email address.
//         <a href="'.route('login').'">Confirm Email Address</a>');

        return view('login-customer');
//        afh

    }

//    use Sendpulse\RestApi\ApiClient;
//    use Sendpulse\RestApi\ApiClient;
//    use Sendpulse\RestApi\Storage\FileStorage;
    public function send_mail($emailToSend, $subject, $text)
    {
//        $apikey = '4e5fed707ad79b48267aa3e73efa00e1-us3';
//
//        $to_emails = array($emailToSend);
//        $to_names = array('You');
//
//        $message = array(
//            'html'=>'Yo, this is the <b>html</b> portion',
//            'text'=>'Yo, this is the *text* portion',
//            'subject'=>'This is the subject',
//            'from_name'=>'Me!',
//            'from_email'=>'verifed@example.com',
//            'to_email'=>$to_emails,
//            'to_name'=>$to_names
//        );
//
//        $tags = array('WelcomeEmail');
//
//        $params = array(
//            'apikey'=>$apikey,
//            'message'=>$message,
//            'track_opens'=>true,
//            'track_clicks'=>false,
//            'tags'=>$tags
//        );
//
//        $url = "http://us1.sts.mailchimp.com/1.0/SendEmail";
//
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url.'?'.http_build_query($params));
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//
//        $result = curl_exec($ch);
//        echo $result;
//        curl_close ($ch);
//
//        $data = json_decode($result);
//        echo "Status = ".$data->status."\n";
//        --------------
//        $email = new \SendGrid\Mail\Mail();
//        $email->setFrom("qaqa@qaqa.com", "Example User");
//        $email->setSubject($subject);
//        $email->addTo($emailToSend, "Example User");
//        $email->addContent(
//            "text/plain", $text
//        );
//        $email->addContent(
//            "text/html", "<strong>".$text."</strong>"
//        );
//        $sendgrid = new \SendGrid('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');
//        try {
//            $response = $sendgrid->send($email);
//            print $response->statusCode() . "\n";
//            print_r($response->headers());
//            print $response->body() . "\n";
//        } catch (Exception $e) {
//            echo 'Caught exception: ',  $e->getMessage(), "\n";
//        }
//        ==============

//        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
//        $SPApiClient = new ApiClient('31eba642f3d479cc9b564d51126c5ef5', '1a88ebad44cdf5a19d83ac0a3288928d');
//        $email = array(
//            'html' => '<p>Hello!</p>',
//            'text' => 'Hello!',
//            'subject' => 'Mail subject',
//            'from' => array(
//                'name' => 'John',
//                'email' => 'sender@example.com',
//            ),
//            'to' => array(
//                array(
//                    'name' => 'Subscriber Name',
//                    'email' => $email,
//                ),
//            ),
//        );
//        var_dump($SPApiClient->smtpSendMail($email));
//        'bcc' => array(
//        array(
//            'name' => 'Manager',
//            'email' => 'manager@example.com',
//        ),
//        ),
//                'attachments' => array(
//            'file.txt' => file_get_contents(PATH_TO_ATTACH_FILE),
//        ),


//        $SPApiProxy = new \Sendpulse\RestApi\ApiClient('31eba642f3d479cc9b564d51126c5ef5', '1a88ebad44cdf5a19d83ac0a3288928d', new \Sendpulse\RestApi\Storage\FileStorage());
//        $email = ['html' => $text, 'text' => strip_tags($text), 'subject' => $subject, 'from' => ['name' => 'ZAQQULI', 'email' => 'xasohawerXXX@onemail1.com'], 'to' => [['name' => $email, 'email' => $email]]];
//        return $SPApiProxy->smtpSendMail($email);
    }

    /* @POST

     */

    public function login(Request $request){

        $customMessages = [
            'email.required' => 'email daxil edilməlidir',
            'password.required' => 'şifrə daxil edilməlidir',
            'email' => 'email düzgün formatda olmalıdır'
        ];

        $this->validate($request, [

            'email' => 'required|email',

            'password' => 'required',

        ],$customMessages);

        $remember_me = $request->has('remember_me') ? true : false;

        if (\Auth::attempt([

            'email' => $request->email,

            'password' => $request->password],$remember_me)

        ){
            if (!\Auth::user()->verified) {
                auth()->logout();
                return back()->with('error', "Siz emailınızı təstiqləməlisiniz. Biz sizə təstiq linkini gondərdik, zəhmət olmasa emailınıza baxın. 
                Əgər təstiq məktubu gəlməyibsə bu linkle yenisini göndərə bilərsiniz: ")->with('verify-email',($request->email));
            }
//            return redirect()->intended($this->redirectPath());
            if(\Auth::user()->isAdmin()){
                return redirect('admin');
            }

            return redirect('/profile/'.\Auth::user()->email);

        }

//        echo 'cascascascasc';
//        exit;
        return redirect('/login')->with('error', 'Email ve ya şifrə səhfdir');

    }

    /* GET

    */

    public function logout(Request $request)

    {
//        echo 'aa';
//        exit;

        if(\Auth::check())

        {

//            echo 'logout';
//            exit;
            \Auth::logout();

            $request->session()->invalidate();

        }

        return  redirect('login');

//        $this->guard()->logout();
//
//        $request->session()->invalidate();
//
//        return $this->loggedOut($request) ?: redirect('/');

    }

}
