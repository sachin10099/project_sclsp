<?php

namespace App\Http\Middleware;

use Closure;

class FormFiller
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
        if(\Auth::user()->type == 'form_user') {
            return $next($request);    
        }
        return redirect('form-filler/login')->with('error', 'Unauthorized Access!');
        
    }
}
