<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use DB;
use App\Models\Language;

class Vender
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
        if (Session::has('vender')) {
            $user_id = Session::get('vender');
            if (DB::table('saller')->where('id',$user_id)->exists()) {
                return $next($request);
            }
        }    
        
        return redirect()->route('vender_login');
       
    }
}
