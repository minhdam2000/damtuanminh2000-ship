<?php

namespace App\Http\Middleware;
use App\ApiResponse;
use App\Proxy;
use Closure;
class ProxyMiddleWare
{
    public function handle($request, Closure $next)
    {
        $ret = $request->session()->has(Proxy::PROXY_ID);
        if($ret == false){
            return ApiResponse::notfound('Proxy must login before access');
        }
        return $next($request);
    }
}
