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
        // if (!Session::has('token')) {
        //     // Se il token di sessione non è presente, reindirizza l'utente alla pagina di login
        //     return redirect()->route('sign-in');
        // }

        // Se il token di sessione è presente, continua con la richiesta
        return $next($request);
    }
}
