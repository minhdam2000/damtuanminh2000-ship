<?php

namespace App\Http\Middleware;
use App\ApiResponse;
use App\Camera;
use Closure;
class CameraMiddleWare
{
    public function handle($request, Closure $next)
    {
        $ret = $request->session()->has(Camera::CAM_ID);
        if($ret == false){
            return ApiResponse::notfound('Camera must login before access');
        }

        return $next($request);
    }
}
