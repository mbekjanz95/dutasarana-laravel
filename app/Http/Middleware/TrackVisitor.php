<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visitor;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah IP sudah tercatat hari ini
        $existingVisit = Visitor::where('ip_address', $request->ip())
            ->whereDate('visited_at', now()->toDateString())
            ->first();

        if (!$existingVisit) {
            Visitor::create([
                'ip_address' => $request->ip(),
                'visited_at' => now(),
            ]);
        }

       /*  Visitor::create([
            'ip_address' => $request->ip(),
            'visited_at' => now(),
        ]);
 */
        return $next($request);
    }
}
