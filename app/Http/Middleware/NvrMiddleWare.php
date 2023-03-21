<?php

namespace App\Http\Middleware;
use App\ApiResponse;
use App\Nvr;
use Closure;
class NvrMiddleWare
{
    public function handle($request, Closure $next)
    {
        $ret = $request->session()->has(Nvr::NVR_ID);
        if($ret == false){
            return ApiResponse::notfound('NVR must login before access');
        }

        return $next($request);
    }
}
