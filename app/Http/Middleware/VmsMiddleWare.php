<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use DB;

use Closure;

class VmsMiddleWare
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
        $serial_number = $request->route()->parameter('serial_number');
        if($serial_number == "12344321"){
            return $next($request);
        }
        else{
            return;
        }
    }
}
