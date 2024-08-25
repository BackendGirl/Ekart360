<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use DB;
use App\Models\Language;

class Admin
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
        if (Auth()->user()->is_admin == 1) {
            return $next($request);
        }    
        
        return redirect()->route('login');
       
    }
}
