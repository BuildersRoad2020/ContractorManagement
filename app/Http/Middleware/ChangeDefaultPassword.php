<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChangeDefaultPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if(Auth::user()->password_changed_at != null){
            return $next($request);
        }
        if(Auth::user()->password_changed_at == null){
            return redirect()->route('passwordchange');
        }
    }
}
