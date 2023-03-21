<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\User;

use Closure;

class CheckUser
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
        $userId = $request->route()->parameter('userid');
        $adminId = User::where('id', $userId)->first()->admin_id;
        if((Auth()->user()->id) === $adminId){
            return $next($request);
        }
        else{
            return abort(404);
        }
    }
}
