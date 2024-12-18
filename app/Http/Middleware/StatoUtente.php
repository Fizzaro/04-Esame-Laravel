<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StatoUtente
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$requiredStato)
    {
        $stato = ["stato"=>"$request->stato"];
        if (count(array_intersect($requiredStato, $stato)) != 0) {
            return $next($request);
        } else {
            abort(403, 'Abbonamento non regolare');
        }
    }
}
