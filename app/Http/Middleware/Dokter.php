<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Dokter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->get('role') !== 'dokter') {
            
            session()->forget('role');

            return redirect()->to('/')->with('error', 'Anda bukan Admin!');
        }
        return $next($request);
    }
}
