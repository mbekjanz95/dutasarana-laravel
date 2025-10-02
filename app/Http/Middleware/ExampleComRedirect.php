<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExampleComRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ambil full URL yang diakses
        $currentUrl = $request->fullUrl();

        // Cek apakah URL mengandung 'https://example.com/?order_id='
        if (str_contains($currentUrl, 'https://example.com/?order_id=')) {
            return redirect()->to('http://localhost:8000/home'); // Sesuaikan port Laravel lokal Anda
        }

        return $next($request);
    }
}
