<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelpers;
use App\Http\Requests\RegistraStoreRequest;
use App\Http\Resources\UtenteResource;
use App\Models\Utente;
use App\Models\Recapito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Autorizzazione;
use App\Models\Password;

class RegistraController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\RegistraStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegistraStoreRequest $request)
    {

        $dati = $request->validated();

        return DB::transaction(function () use ($dati) {
            $datiUtente = [
                'nome' => $dati['nome'],
                'cognome' => $dati['cognome'],
                'sesso' => $dati['sesso'],
                'dataNascita' => $dati['dataNascita'],
                'comuneNascita' => $dati['comuneNascita'],
                'codFiscale' => $dati['codFiscale']
            ];


            //$utente = route([UtenteController::class, 'store'], [$datiUtente]);
            $valore = Utente::where('codFiscale', $datiUtente['codFiscale'])->first();
            if ($valore == null) {
                //preparare il model
                $utente = Utente::create($dati);
                $idUtente = new UtenteResource($utente);
                $idUtente = $idUtente['idUtente'];
                $datiRecapito = [
                    'idUtente' => $idUtente,
                    'idTipologiaRecapito' => 3,
                    'recapito' => $dati['recapito']
                ];
                Recapito::create($datiRecapito);

                $username = hash('sha512', $dati['username']);
                $password = hash('sha512', $dati['password']);
                //verifica se l'username è già in uso
                if ((Autorizzazione::where('username', $username)->first()) == null) {
                    //salva username e password
                    $user = ['idUtente' => $idUtente, 'username' => $username];
                    Autorizzazione::create($user);
                    $pssw = ['idUtente' => $idUtente, 'pssw' => $password];
                    Password::create($pssw);
                    return AppHelpers::rispostaCustom(['idUtente' => $idUtente, 'username' => $username, 'password' => $password]);
                } else {
                    return AppHelpers::rispostaCustom(null, 'Username già in uso', 400);
                }
            } else {
                return AppHelpers::rispostaCustom(null, 'Utente già registrato', 400);
            }
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
