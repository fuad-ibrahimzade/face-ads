<?php
/**
 * Created by PhpStorm.
 * User: Sabirfd
 * Date: 9/19/2019
 * Time: 18:12
 */
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class HttpsProtocol {

    public function handle($request, Closure $next)
    {
        if (!$request->secure() && (App::environment() === 'production')) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}