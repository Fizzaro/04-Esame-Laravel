<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndirizzoStoreRequest;
use App\Http\Requests\IndirizzoUpdateRequest;
use App\Models\Indirizzo;
use App\Http\Resources\IndirizzoResource;
use App\Http\Resources\IndirizzoCollection;
use App\Helpers\AppHelpers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class IndirizzoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('idUtente') != null) {
            return new IndirizzoCollection(Indirizzo::where('idUtente', request('idUtente'))->get());
        } elseif (request('idComune') != null) {
            return new IndirizzoCollection(Indirizzo::where('idComune', request('idComune'))->get());
        } elseif (request('idTipologiaIndirizzo') != null) {
            return new IndirizzoCollection(Indirizzo::where('idTipologiaIndirizzo', request('idTipologiaIndirizzo'))->get());
        } else {
            return new IndirizzoCollection(Indirizzo::all());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\IndirizzoStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IndirizzoStoreRequest $request)
    {
        //prelevare i dati -> sono già nella request
        //verificare i dati
            $dati = $request->validated();
        //preparare il model
            $film = Indirizzo::create($dati);
        //return risorsa modificata
            return new IndirizzoResource($film);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Indirizzo  $idIndirizzo
     * @return \Illuminate\Http\Response
     */
    public function show(Indirizzo $idIndirizzo)
    {
        $indirizzo = new IndirizzoResource($idIndirizzo);
        if ((Gate::allows("Amministratore")) || (Gate::allows("Membro") && Auth::user()->idUtente == $indirizzo->idUtente)) {
            return $indirizzo;
        } else {
            return AppHelpers::rispostaCustom(null, 'Utente non abilitato', 403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Requests\IndirizzoUpdateRequest  $request
     * @param  \App\Models\Indirizzo  $idIndirizzo
     * @return \Illuminate\Http\Response
     */
    public function update(IndirizzoUpdateRequest $request, Indirizzo $idIndirizzo)
    {
        if (Gate::allows("Amministratore")) {
            //prelevare i dati -> sono già nella request
            //verificare i dati
            $dati = $request->validated();
            //preparare il model
            $idIndirizzo->fill($dati);
            //salvare
            $idIndirizzo->save();
            return new IndirizzoResource($idIndirizzo);
        } elseif (Gate::allows("Membro") && Auth::user()->idUtente == $idIndirizzo->idUtente) {
            $dati = $request->validated();
            $idIndirizzo->fill($dati);
            $idIndirizzo->save();
            return new IndirizzoResource($idIndirizzo);
        } else return AppHelpers::rispostaCustom(null, 'Utente non abilitato', 403);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Indirizzo  $idIndirizzo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Indirizzo $idIndirizzo)
    {
        if ( Gate::allows("Amministratore") || (Gate::allows("Membro") && Auth::user()->idUtente == $idIndirizzo->idUtente)) {
            $idIndirizzo->deleteOrFail();
            return response()->noContent();
        } else return AppHelpers::rispostaCustom(null, 'Utente non abilitato', 403);
    }
}
