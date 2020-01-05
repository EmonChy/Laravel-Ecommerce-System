<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;
use Redirect;

class AccessControl
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
        if(Auth::guard('admin')->check()){
            return redirect()->route('admin.index');
        }else{
           // return redirect('/admin/login');
            return $next($request);
        }
    }
    

}
