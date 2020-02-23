<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Support\Facades\Auth;

class AdministratorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
      $user = $request->user();
     if (Auth::guard($guard)->check()) {
     return $next($request);

     }

    return redirect(route('login'))->with('warning', 'Anda harus masuk terlebih dahulu! ');
    }
}
