<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\AccediController;
use App\Models\Utente;
use Illuminate\Support\Facades\Auth;
use App\Helpers\AppHelpers;

class Autenticazione
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //accedo al token bearer
        $token = $request->bearerToken();
        //codice di controllo per l'autenticazione
        if ($token != null) {
            $payload = AccediController::verificaJWT($token);
            //print_r($payload);
            $utente = Utente::where('idUtente', $payload->data->idUtente)->first();
            if ($utente != null) {
                Auth::login($utente);
                //estrarre lo stato ($payload->data->stato) e inserirlo nella request per il GATE
                $request["stato"] = $payload->data->stato;
                //estrarre il permesso ($payload->data->permesso) e inserirlo nella request per il GATE
                $request["permesso"] = $payload->data->permesso;
                return $next($request);
            } else {
                return AppHelpers::rispostaCustom(null, 'Autenticazione fallita', 403);
                // abort(403, 'Autenticazione fallita');
            }
        } else {
            return AppHelpers::rispostaCustom(null, 'Autenticazione inesistente', 403);
            // abort(403, 'Autenticazione inesistente');
        }
        
    }
}
