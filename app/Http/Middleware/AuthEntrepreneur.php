<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthEntrepreneur
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
        $user = Auth::user();
        if($user->customer_type=='Entrepreneur'){
            return $next($request);
        }
        return redirect('/');
//        if($user && $user->user_made_login==1) {
////            print($user);
////            exit;
//            return $next($request);
//        }
//        if($user && $user->user_made_login==0){
//            Auth::logout();
////            return $next($request);
//        }
//        return redirect('/');
    }
}
