<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Proxy;
use App\Camera;
use App\ProxyPermission;
use DB;

use Closure;

class CheckPermissionCamera
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
        $camId = $request->route()->parameter('camid');
        $proxyId = Camera::where('id',$camId)->first()->proxy_id;
        $proxy_camera = ProxyPermission::where([['user_id', Auth()->user()->id],['proxy_id', $proxyId]])->get();
        if(count($proxy_camera) != 0){
            return $next($request);
        }
        else{
            return abort(404);
        }
    }
}
