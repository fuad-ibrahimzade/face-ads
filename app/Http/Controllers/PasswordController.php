<?php

namespace App\Http\Controllers;

use App\Mail\resetPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//        $this->middleware('right_user_made_login');
//    }
    //
    public function showForm()
    {
        return view('passwords.resetEmail');
    }
    public function sendPasswordResetToken(Request $request)
    {
        $user = \App\User::where ('email', $request->email)->first();
        if ( !$user ) return redirect()->back()->withErrors(['error' => '404']);

//        //create a new token to be sent to the user.
//        DB::table('password_resets')->insert([
//            'email' => $request->email,
//            'token' => Str::random(60), //change 60 to any length you want
//            'created_at' => Carbon::now()
//        ]);
        $user->password_reset_token=Str::random(60);
        $user->save();
//
//        $tokenData = DB::table('password_resets')
//            ->where('email', $request->email)->first();
        $tokenData=$user;

        $token = $tokenData->password_reset_token;
        $email = $request->email; // or $email = $tokenData->email;

        Mail::to($email)->send(new resetPasswordMail($tokenData));

        return back()->with('warning', 'yeni şifrə üçün email göndərildi');
    }
    public function showPasswordResetForm($password_reset_token)
    {
//        $tokenData = DB::table('password_resets')
//            ->where('token', $token)->first();
//
//        if ( !$tokenData ) return redirect()->to('home'); //redirect them anywhere you want if the token does not exist.
//        return view('passwords.show');

        $verifyPasswordResettoken = \App\User::where('password_reset_token', $password_reset_token)->first();
        if(!isset($verifyPasswordResettoken) ){
            return redirect('/login')->with('error', "Bağışlayın sizin link sistemdə taplmadı");
        }

        return view('passwords.resetPasswordForm');
    }
    public function resetPassword(Request $request, $password_reset_token)
    {
        //some validation
//        ...
        $customMessages = [
            'password.confirmed' => 'şifrənin təkrarı səhf daxil edilib',
            'password.required' => 'şifrə daxil edilməlidir'
        ];
        $validate = \Validator::make($request->all(), [
            'password' 	=> 'required|confirmed|max:255'

        ], $customMessages);
//        'password_confirmation' => 'required ',
        if( $validate->fails()){

            return redirect()

                ->back()

                ->withErrors($validate)->withInput();

        }

        $password = $request->password;
        $userData = \App\User::where('password_reset_token', $password_reset_token)->first();

        if ( !$userData ) return redirect()->to('/'); //or wherever you want evvel home idi

        $userData->password = Hash::make($password);
        $userData->password_reset_token = null;
        $userData->save(); //or $user->save(); evvel update idi

        //do we log the user directly or let them login and try their password for the first time ? if yes
        \Auth::login($userData);
        return redirect('/profile');

        // If the user shouldn't reuse the token later, delete the token
//        DB::table('password_resets')->where('email', $user->email)->delete();

    //redirect where we want according to whether they are logged in or not
    }
}
