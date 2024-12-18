<?php

namespace App\Http\Controllers;

use App\Models\Episodio;
use App\Http\Resources\EpisodioResource;
use App\Http\Resources\EpisodioCollection;
use App\Http\Requests\EpisodioUpdateRequest;
use App\Http\Requests\EpisodioStoreRequest;
use Illuminate\Http\Request;

class EpisodioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResource
     */
    public function index()
    {
        if (request('idSerie') != null) {
            return new EpisodioCollection(Episodio::where('idSerie', request('idSerie'))->get());
        } else {
            return new EpisodioCollection(Episodio::all());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\EpisodioStoreRequest  $request
     * @return JsonResource
     */
    public function store(EpisodioStoreRequest $request)
    {
        //prelevare i dati -> sono già nella request
        //verificare i dati
            $dati = $request->validated();
        //preparare il model
            $episodio = Episodio::create($dati);
        //return risorsa modificata
            return new EpisodioResource($episodio);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Episodio  $idEpisodio
     * @return JsonResource
     */
    public function show(Episodio $idEpisodio)
    {
        return new EpisodioResource($idEpisodio);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Requests\EpisodioUpdateRequest  $request
     * @param  \App\Models\Episodio  $episodio
     * @return JsonResource
     */
    public function update(EpisodioUpdateRequest $request, Episodio $idEpisodio)
    {
        //prelevare i dati -> sono già nella request
        //verificare i dati
            $dati = $request->validated();
        //preparare il model
            $idEpisodio->fill($dati);
        //salvare
            $idEpisodio->save();
        //return risorsa modificata
            return new EpisodioResource($idEpisodio);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Episodio  $episodio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Episodio $idEpisodio)
    {
        $idEpisodio->deleteOrFail();
        return response()->noContent();
    }
}
