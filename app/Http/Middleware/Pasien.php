<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Pasien
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->get('role') !== 'pasien') {
            
            session()->forget('role');

            return redirect()->to('/')->with('error', 'Anda bukan pasien!');
        }

        return $next($request);
    }
}
