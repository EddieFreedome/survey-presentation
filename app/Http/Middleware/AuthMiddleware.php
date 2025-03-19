<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $protectedRoutes = ['start', 'pre-lobby'];
        
        if (in_array($request->route()->getName(), $protectedRoutes)) {
            if (!Session::has('token')) {
                return redirect()->route('sign-in');
            }
        }
        
        $name = Session::get('name');
        if (!$name) {
            $name = '';
        }

        Session::put('name', $name);

        // Se il token di sessione è presente, continua con la richiesta
        return $next($request);
    }
}
