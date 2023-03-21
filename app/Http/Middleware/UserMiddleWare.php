<?php

namespace App\Http\Middleware;
use App\ApiResponse;
use App\User;
use Closure;
class UserMiddleWare
{
    public function handle($request, Closure $next)
    {
        $ret = $request->session()->has(User::USER_ID);
        if($ret == false){
            return ApiResponse::notfound('User must login before access');
        }
        
        return $next($request);
    }
}
