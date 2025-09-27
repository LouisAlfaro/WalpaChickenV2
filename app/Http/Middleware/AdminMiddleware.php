<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        /* if (Auth::user()->email !== 'admin@walpa.com') {
        return redirect('/login')->with('error', 'Acceso denegado. Solo administradores.');
        } */


        return $next($request);
    }
}