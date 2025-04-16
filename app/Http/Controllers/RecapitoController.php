<?php

namespace App\Http\Controllers;

use App\Models\Recapito;
use App\Http\Resources\RecapitoResource;
use App\Http\Resources\RecapitoCollection;
use App\Http\Requests\RecapitoUpdateRequest;
use App\Http\Requests\RecapitoStoreRequest;
use App\Helpers\AppHelpers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class RecapitoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('idUtente') != null) {
            return new RecapitoCollection(Recapito::where('idUtente', request('idUtente'))->get());
        } elseif (request('idTipologiaRecapito') != null) {
            return new RecapitoCollection(Recapito::where('idTipologiaRecapito', request('idTipologiaRecapito'))->get());
        } else {
            return new RecapitoCollection(Recapito::all());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\RecapitoStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecapitoStoreRequest $request)
    {
         //prelevare i dati -> sono già nella request
        //verificare i dati
        $dati = $request->validated();
        //preparare il model
            $recapito = Recapito::create($dati);
        //return risorsa modificata
            return new RecapitoResource($recapito);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recapito  $idRecapito
     * @return \Illuminate\Http\Response
     */
    public function show(Recapito $idRecapito)
    {
        $recapito = new RecapitoResource($idRecapito);
        if ((Gate::allows("Amministratore")) || (Gate::allows("Membro") && Auth::user()->idUtente == $recapito->idUtente)) {
            return $recapito;
        } else {
            return AppHelpers::rispostaCustom(null, 'Utente non abilitato', 403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Requests\RecapitoUpdateRequest  $request
     * @param  \App\Models\Recapito  $idRecapito
     * @return \Illuminate\Http\Response
     */
    public function update(RecapitoUpdateRequest $request, Recapito $idRecapito)
    {
        if (Gate::allows("Amministratore")) {
            //prelevare i dati -> sono già nella request
            //verificare i dati
            $dati = $request->validated();
            //preparare il model
            $idRecapito->fill($dati);
            //salvare
            $idRecapito->save();
            return new RecapitoResource($idRecapito);
        } elseif (Gate::allows("Membro") && Auth::user()->idUtente == $idRecapito->idUtente) {
            $dati = $request->validated();
            $idRecapito->fill($dati);
            $idRecapito->save();
            return new RecapitoResource($idRecapito);
        } else {
            return AppHelpers::rispostaCustom(null, 'Utente non abilitato', 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recapito  $idRecapito
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recapito $idRecapito)
    {
        $idRecapito->deleteOrFail();
        return response()->noContent();
    }
}
