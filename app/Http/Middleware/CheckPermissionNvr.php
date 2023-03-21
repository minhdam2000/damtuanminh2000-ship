<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use DB;

use Closure;

class CheckPermissionNvr
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
        $nvrId = $request->route()->parameter('nvrid');
        $nvr = DB::table('nvr_permissions')->where([['user_id', Auth()->user()->id],['nvr_id', $nvrId]])->get();
        if(count($nvr) != 0){
            return $next($request);
        }
        else{
            return abort(404);
        }
    }
}
