<?php

namespace App\Http\Controllers;

use App\Http\Requests\UtenteStoreRequest;
use App\Http\Requests\UtenteUpdateRequest;
use App\Models\Utente;
use App\Http\Resources\UtenteResource;
use App\Http\Resources\UtenteCollection;
use App\Http\Resources\UtenteResourceComplete;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UtenteController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return JsonResource
     */
    public function index()
    {
        $utente = Utente::all();
        if (request('idStato') != null) {
            $utente = $utente->where('idStato', request('idStato'));
        }
        if (request('idPermesso') != null) {
            $utente = $utente->where('idPermesso', request('idPermesso'));
        }
        if (request('cerca') != null) {
            $utente = $utente->where('codFiscale', request('cerca'));
        }
        return new UtenteCollection($utente);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\UtenteStoreRequest  $request
     * @return JsonResource
     */
    public function store(UtenteStoreRequest $request)
    {
        //prelevare i dati -> sono già nella request
        //verificare i dati
            $dati = $request->validated();
            $valore = Utente::where('codFiscale', $dati['codFiscale'])->first();
            if ($valore == null) {
                //preparare il model
                    $utente = Utente::create($dati);
                //return risorsa
                    return new UtenteResource($utente);
            } else {
                abort(400, 'Utente già registrato');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Utente  $utente
     * @return \Illuminate\Http\Response
     */
    public function show(Utente $utente)
    {
        if (Gate::allows("Amministratore")) {
            return new UtenteResourceComplete($utente);
        } elseif (Gate::allows("Membro") && Auth::user()->idUtente == $utente->idUtente) {
            return new UtenteResource($utente);
        } else {
            abort(403, 'Utente non abilitato');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Requests\UtenteUpdateRequest  $request
     * @param  \App\Models\Utente  $utente
     * @return Jsonresource
     */
    public function update(UtenteUpdateRequest $request, Utente $utente)
    {
        if (Gate::allows("Amministratore")) {
            //prelevare i dati -> sono già nella request
            //verificare i dati
            $dati = $request->validated();
            //preparare il model
            $utente->fill($dati);
            //salvare
            $utente->save();
            return new UtenteResourceComplete($utente);
        } elseif (Gate::allows("Membro") && Auth::user()->idUtente == $utente->idUtente) {
            $dati = $request->validated();
            $utente->fill($dati);
            $utente->save();
            return new UtenteResource($utente);
        } else {
            abort(403, 'Utente non abilitato');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Utente  $utente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Utente $utente)
    {
        $utente->deleteOrFail();
        return response()->noContent();
    }

    //---------------------------------------------------------------------------------

    /**
     * Cambia lo stato dell'utente in Inattivo.
     *
     * @param  \App\Models\Utente  $utente
     * @return Jsonresource
     */
    public function disattivaStato(Utente $utente)
    {
        $utente->idStato = 1;
        $utente->save();
        return new UtenteResource($utente);
    }

    /**
     * Cambia lo stato dell'utente in Attivo.
     *
     * @param  \App\Models\Utente  $utente
     * @return Jsonresource
     */
    public function attivaStato(Utente $utente)
    {
        $utente->idStato = 2;
        $utente->save();
        return new UtenteResource($utente);
    }

    /**
     * Cambia lo stato dell'utente in Sospeso.
     *
     * @param  \App\Models\Utente  $utente
     * @return Jsonresource
     */
    public function sospendiStato(Utente $utente)
    {
        $utente->idStato = 3;
        $utente->save();
        return new UtenteResource($utente);
    }


    /**
     * Cambia il permesso dell'utente in Amministratore.
     *
     * @param  \App\Models\Utente  $utente
     * @return Jsonresource
     */
    public function rendiAmministratore(Utente $utente)
    {
        $utente->idPermesso = 1;
        $utente->save();
        return new UtenteResource($utente);
    }

    /**
     * Cambia il permesso dell'utente in Membro.
     *
     * @param  \App\Models\Utente  $utente
     * @return Jsonresource
     */
    public function rendiMembro(Utente $utente)
    {
        $utente->idPermesso = 2;
        $utente->save();
        return new UtenteResource($utente);
    }

    /**
     * Cambia il permesso dell'utente in Ospite.
     *
     * @param  \App\Models\Utente  $utente
     * @return Jsonresource
     */
    public function rendiOspite(Utente $utente)
    {
        $utente->idPermesso = 3;
        $utente->save();
        return new UtenteResource($utente);
    }
}