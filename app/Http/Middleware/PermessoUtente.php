<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PermessoUtente
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$requiredPermessi)
    {
        $permesso = ["permesso"=>$request->permesso];
        if (count(array_intersect($requiredPermessi, $permesso)) != 0) {
            return $next($request);
        } else {
            abort(403, 'Permesso non valido');
        }
    }
}
