<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RightUserMadeLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        arabir databazani pozanda qatiqliyir useri gosterir teze databasa seed edende amma verified 0 olur deyne bele workarount ele
        $user = Auth::user();
        $parameters=$request->route()->parameters();
//        || (!isset($parameters['email']))
        if(isset($parameters['email']) && $parameters['email']==$user->email){
            return $next($request);
        }
//        if(Session::has('mazgia') && bcrypt($user->email)==Session::get('mazgia')){
//            return $next($request);
//        }
//        if(Auth::check()){
//            print($user);
//            exit;
//        }
//        if($user && $user->user_made_login==1) {
////            print($user);
////            exit;
//            return $next($request);
//        }
//        if($user && $user->user_made_login==0){
//            Auth::logout();
////            return $next($request);
//        }
        Auth::logout();
        return redirect('/');
//        return $next($request);
    }
}
