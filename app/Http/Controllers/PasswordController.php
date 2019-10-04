<?php

namespace App\Http\Controllers;

use App\Mail\resetPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordController extends Controller
{

    public function showForm()
    {
        return view('passwords.resetEmail');
    }
    public function sendPasswordResetToken(Request $request)
    {
        $user = \App\User::where ('email', $request->email)->first();
        if ( !$user ) return redirect()->back()->withErrors(['error' => '404']);

        $user->password_reset_token=Str::random(60);
        $user->save();

        $tokenData=$user;

        $token = $tokenData->password_reset_token;
        $email = $request->email; // or $email = $tokenData->email;

        Mail::to($email)->send(new resetPasswordMail($tokenData));

        return back()->with('warning', 'yeni şifrə üçün email göndərildi');
    }
    public function showPasswordResetForm($password_reset_token)
    {

        $verifyPasswordResettoken = \App\User::where('password_reset_token', $password_reset_token)->first();
        if(!isset($verifyPasswordResettoken) ){
            return redirect('/login')->with('error', "Bağışlayın sizin link sistemdə taplmadı");
        }

        return view('passwords.resetPasswordForm');
    }
    public function resetPassword(Request $request, $password_reset_token)
    {
        $customMessages = [
            'password.confirmed' => 'şifrənin təkrarı səhf daxil edilib',
            'password.required' => 'şifrə daxil edilməlidir'
        ];
        $validate = \Validator::make($request->all(), [
            'password' 	=> 'required|confirmed|max:255'

        ], $customMessages);
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
        return redirect('/profile/'.auth()->user()->email);
    }
}
