<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SlowDown
{
    public function handle(Request $request, Closure $next)
    {
        // n’activer que sur la route /cartes (ou un prefix)
        //dd($request->is('/'));
        if ($request->is('/')) {

            $min = (int) env('SLOW_MIN', 1);
            $max = (int) env('SLOW_MAX', 2);
            sleep(random_int($min, $max)); // bloque le worker
             // pour test
        }
        return $next($request);
    }
}
