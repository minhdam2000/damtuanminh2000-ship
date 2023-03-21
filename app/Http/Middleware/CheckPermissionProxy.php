<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use DB;

use Closure;

class CheckPermissionProxy
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
        $proxyId = $request->route()->parameter('proxyid');
        $proxy = DB::table('proxy_permissions')->where([['user_id', Auth()->user()->id],['proxy_id', $proxyId]])->get();

        $nvrId = $request->route()->parameter('nvrid');
        if($nvrId){
            $check = ((count($proxy) != 0) || $proxyId == 'null');
        }
        else{
            $check = (count($proxy) != 0);
        }
    
        if($check){
            return $next($request);
        }
        else{
            return abort(404);
        }
    }
}
