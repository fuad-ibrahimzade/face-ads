<?php

namespace App\Http\Controllers;

use App\Mail\VerifyMail;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;

//use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
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
            if($request->is('freelancer*')){
                return view('freelancer');
            }
            else if($request->is('agency*')){
                return view('agency');
            }
            else if($request->is('brand*')){
                return view('sahibkar');
            }
        }
    }

    public function registrationForm(Request $request)
    {
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

    }

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
//        'name' 		=> 'required|string|regex:/^[a-zA-Z][a-zA-Z0-9 ,.\'-]+$/i',
        $requirementsArray=[

            'name' 		=> 'required|string|regex:/^[a-zA-Z][a-zA-Z0-9üÜöÖəƏğĞçÇşŞ ,.\'-]+$/i',

            'email'	 	=> 'required|email|unique:users|max:255',

            'password' 	=> 'nullable|confirmed|max:255',


            'profile_image' => 'sometimes|required|mimes:jpeg,png,jpg,gif,svg',

            'activity' 		=> 'required',

            'sector' 		=> 'required',

            'city' 		=> 'required'

        ];

        if($customer_type!='Entrepreneur')$requirementsArray['pricing']='required';
        $validate = \Validator::make($request->all(), $requirementsArray, $customMessages);


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

        $cities=["VI"=>"ABŞ Virgin adaları","UM"=>"ABŞ-a bağlı ki&ccedil;ik adacıqlar","AX"=>"Aland adaları","AL"=>"Albaniya","DE"=>"Almaniya","US"=>"Amerika Birləşmiş Ştatları","AS"=>"Amerika Samoası","AD"=>"Andorra","AI"=>"Angilya","AO"=>"Anqola","AQ"=>"Antarktika","AG"=>"Antiqua və Barbuda","AR"=>"Argentina","AW"=>"Aruba","AC"=>"Askenson adası","AU"=>"Avstraliya","AT"=>"Avstriya","AZ"=>"Azərbaycan","BS"=>"Baham adaları","BD"=>"Banqladeş","BB"=>"Barbados","BY"=>"Belarus","BE"=>"Bel&ccedil;ika","BZ"=>"Beliz","BJ"=>"Benin","BM"=>"Bermud adaları","BH"=>"Bəhreyn","AE"=>"Birləşmiş Ərəb Əmirlikləri","GB"=>"Birləşmiş Krallıq","BO"=>"Boliviya","BG"=>"Bolqarıstan","BA"=>"Bosniya və Herseqovina","BW"=>"Botsvana","BR"=>"Braziliya","IO"=>"Britaniyanın Hind Okeanı Ərazisi","VG"=>"Britaniyanın Virgin adaları","BN"=>"Bruney","BF"=>"Burkina Faso","BI"=>"Burundi","BT"=>"Butan","JE"=>"Cersi","GI"=>"Cəbəll&uuml;tariq","ZA"=>"Cənub Afrika","GS"=>"Cənubi Corciya və Cənubi Sendvi&ccedil; adaları","KR"=>"Cənubi Koreya","SS"=>"Cənubi Sudan","DJ"=>"Cibuti","TD"=>"&Ccedil;ad","CZ"=>"&Ccedil;exiya","CL"=>"&Ccedil;ili","CN"=>"&Ccedil;in","DK"=>"Danimarka","DG"=>"Dieqo Qarsiya","DM"=>"Dominika","DO"=>"Dominikan Respublikası","ET"=>"Efiopiya","EC"=>"Ekvador","GQ"=>"Ekvatorial Qvineya","ER"=>"Eritreya","AM"=>"Ermənistan","EE"=>"Estoniya","SZ"=>"Esvatini","AF"=>"Əfqanıstan","DZ"=>"Əlcəzair","FO"=>"Farer adaları","PS"=>"Fələstin Əraziləri","FJ"=>"Fici","PH"=>"Filippin","FI"=>"Finlandiya","FK"=>"Folklend adaları","FR"=>"Fransa","GF"=>"Fransa Qvianası","PF"=>"Fransa Polineziyası","TF"=>"Fransanın Cənub Əraziləri","GG"=>"Gernsi","GE"=>"G&uuml;rc&uuml;stan","HT"=>"Haiti","IN"=>"Hindistan","HN"=>"Honduras","HK"=>"Honq Konq X&uuml;susi İnzibati Ərazi &Ccedil;in","HR"=>"Xorvatiya","ID"=>"İndoneziya","JO"=>"İordaniya","IQ"=>"İraq","IR"=>"İran","IE"=>"İrlandiya","IS"=>"İslandiya","ES"=>"İspaniya","IL"=>"İsrail","SE"=>"İsve&ccedil;","CH"=>"İsve&ccedil;rə","IT"=>"İtaliya","CV"=>"Kabo-Verde","KH"=>"Kamboca","CM"=>"Kamerun","CA"=>"Kanada","IC"=>"Kanar adaları","BQ"=>"Karib Niderlandı","KY"=>"Kayman adaları","KE"=>"Keniya","CY"=>"Kipr","KI"=>"Kiribati","CC"=>"Kokos (Kilinq) adaları","CO"=>"Kolumbiya","KM"=>"Komor adaları","CG"=>"Konqo - Brazzavil","CD"=>"Konqo - Kinşasa","XK"=>"Kosovo","CR"=>"Kosta Rika","CI"=>"Kotd&rsquo;ivuar","CU"=>"Kuba","CK"=>"Kuk adaları","CW"=>"Kurasao","KW"=>"K&uuml;veyt","GA"=>"Qabon","GM"=>"Qambiya","GH"=>"Qana","GY"=>"Qayana","KZ"=>"Qazaxıstan","EH"=>"Qərbi Saxara","QA"=>"Qətər","KG"=>"Qırğızıstan","GD"=>"Qrenada","GL"=>"Qrenlandiya","GU"=>"Quam","GP"=>"Qvadelupa","GT"=>"Qvatemala","GN"=>"Qvineya","GW"=>"Qvineya-Bisau","LA"=>"Laos","LV"=>"Latviya","LS"=>"Lesoto","LR"=>"Liberiya","LI"=>"Lixtenşteyn","LT"=>"Litva","LB"=>"Livan","LY"=>"Liviya","LU"=>"L&uuml;ksemburq","HU"=>"Macarıstan","MG"=>"Madaqaskar","MO"=>"Makao X&uuml;susi İnzibati Ərazi &Ccedil;in","MK"=>"Makedoniya","MW"=>"Malavi","MY"=>"Malayziya","MV"=>"Maldiv adaları","ML"=>"Mali","MT"=>"Malta","MH"=>"Marşal adaları","MQ"=>"Martinik","MU"=>"Mavriki","MR"=>"Mavritaniya","YT"=>"Mayot","MX"=>"Meksika","IM"=>"Men adası","MA"=>"Mərakeş","CF"=>"Mərkəzi Afrika Respublikası","FM"=>"Mikroneziya","CX"=>"Milad adası","EG"=>"Misir","MD"=>"Moldova","MC"=>"Monako","MN"=>"Monqolustan","MS"=>"Monserat","ME"=>"Monteneqro","MZ"=>"Mozambik","PM"=>"M&uuml;qəddəs Pyer və Mikelon","SH"=>"M&uuml;qəddəs Yelena","MM"=>"Myanma","NA"=>"Namibiya","NR"=>"Nauru","NP"=>"Nepal","NL"=>"Niderland","NE"=>"Niger","NG"=>"Nigeriya","NI"=>"Nikaraqua","NU"=>"Niue","NF"=>"Norfolk adası","NO"=>"Norve&ccedil;","OM"=>"Oman","UZ"=>"&Ouml;zbəkistan","PK"=>"Pakistan","PW"=>"Palau","PA"=>"Panama","PG"=>"Papua-Yeni Qvineya","PY"=>"Paraqvay","PE"=>"Peru","PN"=>"Pitkern adaları","PL"=>"Polşa","PT"=>"Portuqaliya","XA"=>"Psevdo-Aksent","XB"=>"Psevdo-Bidi","PR"=>"Puerto Riko","RE"=>"Reyunyon","RW"=>"Ruanda","RO"=>"Rumıniya","RU"=>"Rusiya","SV"=>"Salvador","WS"=>"Samoa","SM"=>"San-Marino","ST"=>"San-Tome və Prinsipi","SN"=>"Seneqal","MF"=>"Sent Martin","BL"=>"Sent-Bartelemi","KN"=>"Sent-Kits və Nevis","LC"=>"Sent-Lusiya","VC"=>"Sent-Vinsent və Qrenadinlər","RS"=>"Serbiya","EA"=>"Seuta və Melilya","SC"=>"Seyşel adaları","SA"=>"Səudiyyə Ərəbistanı","SG"=>"Sinqapur","SX"=>"Sint-Marten","SK"=>"Slovakiya","SI"=>"Sloveniya","SB"=>"Solomon adaları","SO"=>"Somali","SD"=>"Sudan","SR"=>"Surinam","SY"=>"Suriya","SJ"=>"Svalbard və Yan-Mayen","SL"=>"Syerra-Leone","TL"=>"Şərqi Timor","KP"=>"Şimali Koreya","MP"=>"Şimali Marian adaları","LK"=>"Şri-Lanka","TJ"=>"Tacikistan","TH"=>"Tailand","TZ"=>"Tanzaniya","TW"=>"Tayvan","TK"=>"Tokelau","TG"=>"Toqo","TO"=>"Tonqa","TC"=>"T&ouml;rks və Kaykos adaları","TT"=>"Trinidad və Tobaqo","TA"=>"Tristan da Kunya","TN"=>"Tunis","TV"=>"Tuvalu","TR"=>"T&uuml;rkiyə","TM"=>"T&uuml;rkmənistan","UA"=>"Ukrayna","UG"=>"Uqanda","WF"=>"Uollis və Futuna","UY"=>"Uruqvay","VU"=>"Vanuatu","VA"=>"Vatikan","VE"=>"Venesuela","VN"=>"Vyetnam","JM"=>"Yamayka","JP"=>"Yaponiya","NC"=>"Yeni Kaledoniya","NZ"=>"Yeni Zelandiya","YE"=>"Yəmən","GR"=>"Yunanıstan","ZM"=>"Zambiya","ZW"=>"Zimbabve"];
        $city=$cities[$request->city];

        $social_links=null;
        if(isset($request->social)){
            $social_links=array();
            $social_links['Facebook']=$request->social[0];
            $social_links['Twitter']=$request->social[1];
            $social_links['Instagram']=$request->social[2];
            $social_links['Youtube']=$request->social[3];
            $social_links['Pinterest']=$request->social[4];
            $social_links['Whatsapp']=$request->social[5];
            $social_links['Yelp']=$request->social[6];
            $social_links['Skype']=$request->social[7];
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

            'social_links'  =>  $social_links,

            'city' 		=> $city,

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



//        VACIB
        $user_create->verified = 1;
        $user_create->save();
        return redirect('login')->with('success', 'Qeydiyyat uğurla keçdi. Daxil ola bilərsiniz');
//        SONRA AKTIV ELE VACIB YUXARIDAKI VERIFY VE ELQELI SAVEI KOMMENTLE SORA
//        Mail::to($user_create->email)->send(new VerifyMail($user_create));
//        return redirect('login')->with('success', 'Qeydiyyat uğurla keçdi. Verifikasiya üçün zəhmət olmasa emailınıza baxin.');

    }

    public function verifyUser($token){
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
        $user = \App\User::where('email', $email)->first();
        $verifyuser = \App\VerifyUser::where('email', $email)->first();
        if(isset($user) ) {
            Mail::to($email)->send(new VerifyMail($user));
        }
        else{
            return redirect('/login')->with('warning', 'yeni verivikasiya emailı göndərilmədi. zəjmət olmasa yenidən qeydiyyatdan keçin.');
        }
        return redirect('/login')->with('warning', 'yeni verivikasiya emailı göndərildi');
    }

    public function showLoginForm()
    {
        return view('login-customer');
    }

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

        return redirect('/login')->with('error', 'Email ve ya şifrə səhfdir');

    }

    public function logout(Request $request)

    {

        if(\Auth::check())

        {
            \Auth::logout();

            $request->session()->invalidate();

        }

        return  redirect('login');


    }

}
