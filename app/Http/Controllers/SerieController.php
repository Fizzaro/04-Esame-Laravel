<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use App\Http\Resources\SerieResource;
use App\Http\Resources\SerieCollection;
use App\Http\Requests\SerieUpdateRequest;
use App\Http\Requests\SerieStoreRequest;
use Illuminate\Http\Request;

class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResource
     */
    public function index()
    {
        if (request('idCategoria') != null) {
            return new SerieCollection(Serie::where('idCategoria', request('idCategoria'))->get());
        } elseif ($cerca=request("cerca")) {
            return new SerieCollection(Serie::where('titolo', $cerca)->get());
        } else {
            return new SerieCollection(Serie::all());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\SerieStoreRequest  $request
     * @return JsonResource
     */
    public function store(SerieStoreRequest $request)
    {
        //prelevare i dati -> sono già nella request
        //verificare i dati
            $dati = $request->validated();
        //preparare il model
            $serie = Serie::create($dati);
        //return risorsa modificata
            return new SerieResource($serie);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Serie  $serie
     * @return JsonResource
     */
    public function show(Serie $idSerie)
    {
        return new SerieResource($idSerie);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Requests\SerieUpdateRequest  $request
     * @param  \App\Models\Serie  $idSerie
     * @return JsonResource
     */
    public function update(SerieUpdateRequest $request, Serie $idSerie)
    {
        //prelevare i dati -> sono già nella request
        //verificare i dati
            $dati = $request->validated();
        //preparare il model
            $idSerie->fill($dati);
        //salvare
            $idSerie->save();
        //return risorsa modificata
            return new SerieResource($idSerie);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Serie  $idSerie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Serie $idSerie)
    {
        $idSerie->deleteOrFail();
        return response()->noContent();
    }
}
