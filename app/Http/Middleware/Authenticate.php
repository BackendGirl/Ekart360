<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Route;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {

            $controllerMethod = $request->route()->getActionMethod();

        // Check if the controller method starts with 'api_'
        if (str_starts_with($controllerMethod, 'api_')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

            if(Route::is('student.*')){
                return route('student.login');
            }

            if(Route::is('admin.*')){
                return route('login');
            }

            return route('login');

        }
    }
}
