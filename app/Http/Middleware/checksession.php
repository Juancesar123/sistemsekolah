<?php

namespace App\Http\Middleware;

use Closure;

class checksession
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
        if($request->session()->get('name') == null){
            return redirect('/');
        }else{
            return $next($request);
        }
     
    }
}
