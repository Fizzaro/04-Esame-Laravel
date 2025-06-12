<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Autorizzazione;
use App\Models\Password;
use App\Models\Config;
use App\Models\Accesso;
use App\Models\Sessione;
use App\Models\Utente;
use App\Helpers\AppHelpers;

class AccediController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Creazione nuove credenziali
     *
     * @param  string  $idUtente
     * @param  string  $username
     * @param  string  $password
     * @return \Illuminate\Http\Response
     */
    public function store($idUtente, $username, $password)
    {
        //verifica l'esistenza dell'utente
        $utente = Utente::where('idUtente', $idUtente)->first();
        if ($utente == null) {
            return AppHelpers::rispostaCustom(null, 'Utente non trovato', 403);
        //verifica se l'utente è già registrato
        } else if ((Autorizzazione::where('idUtente', $idUtente)->first()) == null){
            $username = hash('sha512', $username);
            $password = hash('sha512', $password);
            //verifica se l'username è già in uso
            if ((Autorizzazione::where('username', $username)->first()) == null){
                //salva username e password
                $user = ['idUtente'=>$idUtente, 'username'=>$username];
                Autorizzazione::create($user);
                $pssw = ['idUtente'=>$idUtente, 'pssw'=>$password];
                Password::create($pssw);
                return ['idUtente'=>$idUtente, 'username'=>$username];
            } else {
                return AppHelpers::rispostaCustom(null, 'Username già in uso', 400);
            }
        }else {
            return AppHelpers::rispostaCustom(null, 'Utente già registrato', 400);
        }
    }

    /**
     * Punto di ingresso del login
     *
     * @param  string  $utente
     * @param  string  $hash
     * @return \Illuminate\Http\Response
     */
    public function show($utente, $hash = null)
    {
        if ($hash == null) {
            return AccediController::controlUsername($utente);
        } else {
            return AccediController::controlPssw($utente, $hash);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * 
     */
    public function modify($idUtente, $vecchiaPssw, $nuovaPssw)
    {
        //verifica l'esistenza dell'utente
        $utente = Utente::where('idUtente', $idUtente)->first();
        if ($utente == null) {
            return AppHelpers::rispostaCustom(null, 'Utente non trovato', 403);
        } else {
            $vecchiaPssw = hash('sha512', $vecchiaPssw);
            $password = Password::where('idUtente', $idUtente)->first();
            //verifica se la vecchia password corrisponde
            if ($password->pssw == $vecchiaPssw) {
                $nuovaPssw = hash('sha512', $nuovaPssw);
                //modifica e salva nuova password
                $password->pssw = $nuovaPssw;
                $password->save();
                return AppHelpers::rispostaCustom(null, 'Password modificata con successo');
            } else {
                return AppHelpers::rispostaCustom(null, 'Vecchia password non corrisponde', 400);
            }
        }
    }

    // ----------------------------------------------------------------------------------------------------------
    
    /**
     * Verifica il token
     *
     * @param  string  $tokenClient
     * @return object
     */
    public static function verificaJWT($tokenClient)
    {
        //prelevo il token dalla sessione se esiste
        $tokenDB = Sessione::where('token', $tokenClient)->first();
        if ($tokenDB != null) {
            $scadSessione = $tokenDB->scadenza;
            //controllo la scadenza del token
            if (time() < $scadSessione) {
                //prendo id utente e lo uso per ricavare il secret JWT
                $idUtente = $tokenDB->idUtente;
                $auth = Autorizzazione::where('idUtente', $idUtente)->first();
                if ($auth != null) {
                    $secret = $auth->secretJWT;
                    //estraggo il payload dal token
                    $payload = AppHelpers::estraiPayload($tokenClient, $secret);
                    if ($payload != null) {
                        return $payload;
                    } else {
                        return AppHelpers::rispostaCustom(null, 'Payload non trovato', 404);
                    }
                } else {
                    return AppHelpers::rispostaCustom(null, 'Utente non trovato', 403);
                }
            } else {
                return AppHelpers::rispostaCustom(null, 'Token scaduto, accedi con credenziali', 400);
            }
        } else {
            return AppHelpers::rispostaCustom(null, 'Utente non abilitato', 403);
        }
    }


    /**
     * Crea il token per sviluppo
     *
     * @param string $utente
     * @return AppHelper\rispostaCustom
     */
    public static function testLogin($hashUtente, $hashPassword)
    {
        if (Autorizzazione::validaUsername($hashUtente)) {
            $auth = Autorizzazione::where('username', $hashUtente)->first();
            $auth->secretJWT = hash("sha512", trim(Str::random(200)));
            $auth->sfida = time();
            $auth->save();

        }
        print_r(AccediController::controlPssw($hashUtente, $hashPassword));
    }

    // ----- PROTECTED -------------------------------------------------

    /**
     * Controlla la username
     *
     * @param  string  $utente
     * @return \Illuminate\Http\Response
     */
    protected static function controlUsername($utente)
    {
        //creo il sale e la sfida a prescindere
        // $sale = hash('sha512', trim(Str::random(200)));
        //sale fisso per sviluppo
        $sale = hash('sha512', trim("ciao"));
        $sfida = time();
        //controllo se esiste l'utente
        if (Autorizzazione::validaUsername($utente)) {
            //prendo l'idUtente
            $idUser = Autorizzazione::where('username', $utente)->first();
            //creo e assegno il secret JWT
            $idUser->secretJWT = hash('sha512', trim(Str::random(200)));
            //creo e assegno l'inizio sfida
            $idUser->sfida = $sfida;
            //salvo su DB
            $idUser->save();

            //prendo il record con la password dell'utente
            $passUser = Password::ultimaPassword($idUser->idUtente);
            //assegno il sale
            $passUser->sale = $sale;
            //salvo su DB
            $passUser->save();
        }
        return AppHelpers::rispostaCustom(['sale' => $sale, 'sfida' => $sfida]);

    }

    /**
     * Controlla la password
     *
     * @param  string  $utente
     * @param  string  $hashClient
     * @return \Illuminate\Http\Response
     */
    protected static function controlPssw($utente, $hashClient)
    {
        //controllo se esiste l'utente
        if (Autorizzazione::validaUsername($utente)) {
            //prendo l'utente
            $idUser = Autorizzazione::where('username', $utente)->first();
            //prendo idUtente
            $idUtente = $idUser->idUtente;
            //prendo il secret JWT
            $secretJWT = $idUser->secretJWT;
            //prendo l'inizio sfida
            $inizioSfida = $idUser->sfida;
            //prendo la durata sfida
            $durataSfida = Config::durataSfida();
            //calcolo sfida
            $scadSfida = $inizioSfida + $durataSfida;
            //prendo numero max di tentativi login
            $tentativi = Config::tentativiAccesso();

            //controllo se la sfida è scaduta
            if (time() < $scadSfida) {
                //prendo il numero dei tentativi di accesso dal DB
                $tentativiUtente = Accesso::nAccessiUtente($idUtente);
                // controllo se il numero massimo dei tentativi è stato superato
                if ($tentativiUtente < $tentativi) {
                    //prendo il record con la password dell'utente dal DB
                    $passUser = Password::ultimaPassword($idUtente);
                    //prendo il sale
                    $sale = $passUser->sale;
                    //prendo la password
                    $password = $passUser->pssw;
                    //creo l'hash
                    $creaHash = AppHelpers::creaHash($password, $sale);

                    //controllo se l'hash inserito corrisponde a quello registrato
                    if ($hashClient == $creaHash) {
                        //creo il token jwt
                        $token = AppHelpers::creaJWT($idUtente, $secretJWT);
                        Accesso::eliminaTentativiFalliti($idUtente);
                        Accesso::aggiungiAccesso($idUtente);
                        //elimino eventuale sessione precedente e creo nuova sessione
                        Sessione::eliminaSessione($idUtente);
                        Sessione::aggiungiSessione($idUtente, $token);
                        return AppHelpers::rispostaCustom(['token' => $token]);
                    } else {
                        Accesso::tentativoFallito($idUtente);
                        return AppHelpers::rispostaCustom(null, 'Tentativo fallito', 403);
                    }
                } else {
                    return AppHelpers::rispostaCustom(null, 'Troppi tentativi', 403);
                }
            } else {
                return AppHelpers::rispostaCustom(null, 'Sessione scaduta', 400);
            }
        } else {
            return AppHelpers::rispostaCustom(null, 'Tentativo fallito', 403);
        }
    }

}
