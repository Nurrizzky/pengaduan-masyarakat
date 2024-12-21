<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isNotLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pada IsNotLogin in berguna pada saat user sudah login dan ingin kembali ke halaman login
        if (Auth::check() == false) 
        { 
            return $next($request);
        }
        else{
            return redirect()->back()->with('failed', 'Anda Sudah Login');
        }
    }
}
