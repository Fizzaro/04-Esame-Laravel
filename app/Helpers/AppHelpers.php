<?php

namespace App\Helpers;

use App\Models\Config;
use App\Models\Permesso;
use App\Models\Stato;
use App\Models\Utente;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\DB;

class AppHelpers {

        //funzione da utilizzare per rules di request UPDATE
        public static function aggiornaRegoleHelper($rules) {
            
            $newRules = Arr::map($rules, function($value, $key){
                return Str::replace('required|', '', $value);
            });

            return $newRules;
        }

        /**
         * Crea l'hash unendo password e sale
         * @param string $pssw
         * @param string $sale
         * @return string $hash
         */
        public static function creaHash($pssw, $sale) {
            return hash('sha512', $pssw . $sale);
        }

        /**
         * Crea il token JWT
         * @param string $idUtente
         * @param string $secretJWT
         * @return string $token
         */
        public static function creaJWT($idUtente, $secretJWT,$scade=null) {
            $iat = time();
            $scadenza = ($scade==null) ? Config::durataSessione() : $scade;
            $utente = Utente::where('idUtente', $idUtente)->first();
            $idPermesso = $utente->idPermesso;
            $permesso = Permesso::where('idPermesso', $idPermesso)->first()->permesso;
            $idStato = $utente->idStato;
            $stato = Stato::where('idStato', $idStato)->first()->stato;
            $idAzioni = DB::table('permessi_azioni')->where('idPermesso', $idPermesso)->pluck('idAzione')->toArray();
            $azioni = array_map(function ($arr) {
                $az = DB::table('azioni')->where('idAzione', $arr)->first();
                return $az->azione;
            }, $idAzioni);
            $payload = [
                'iss' => 'Codex',
                'aud' => 'null',
                'iat' => $iat,
                'nbf' => $iat,
                'exp' => $iat + $scadenza,
                'data' => [
                    'idUtente' => $idUtente,
                    'stato' => $stato,
                    'permesso' => $permesso,
                    'azioni' => $azioni,
                    'nomeCompleto' => $utente->nome .' '. $utente->cognome
                ]
            ];
            $token = JWT::encode($payload, $secretJWT, 'HS512');
            return $token;
        }

        /**
         * Estrae il payload dal token JWT
         * @param string $token
         * @param string $secretJWT
         * @return string payload
         */
        public static function estraiPayload($token, $secretJWT) {
            return JWT::decode($token, new Key($secretJWT, 'HS512'));
        }
    

            // ----------------------------------------------------------------------------------------------------------
    /**
     * Uniforma la risposta
     *
     * @param array $dati Dati richiesti
     * @param string $msg
     * @param array $err
     * @return array
     */
    public static function rispostaCustom($dati, $msg = null, $err = null)
    {
        $response = array();
        $response["data"] = $dati;
        if ($msg != null) $response["message"] = $msg;
        if ($err != null) $response["error"] = $err;
        return $response;
    }
}
