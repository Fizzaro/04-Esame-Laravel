<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Http\Resources\FilmResource;
use App\Http\Resources\FilmCollection;
use App\Http\Requests\FilmUpdateRequest;
use App\Http\Requests\FilmStoreRequest;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResource
     */
    public function index()
    {
        if (request('idCategoria') != null) {
            return new FilmCollection(Film::where('idCategoria', request('idCategoria'))->get());            
        } elseif ($cerca=request("cerca")) {
            return new FilmCollection(Film::where('titolo', $cerca)->get());
        } else {
            return new FilmCollection(Film::all());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\FilmStoreRequest  $request
     * @return JsonResource
     */
    public function store(FilmStoreRequest $request)
    {
        //prelevare i dati -> sono già nella request
        //verificare i dati
            $dati = $request->validated();
        //preparare il model
            $film = Film::create($dati);
        //return risorsa modificata
            return new FilmResource($film);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Film  $idFilm
     * @return JsonResource
     */
    public function show(Film $idFilm)
    {
        return new FilmResource($idFilm);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Requests\FilmUpdateRequest  $request
     * @param  \App\Models\Film  $idFilm
     * @return JsonResource
     */
    public function update(FilmUpdateRequest $request, Film $idFilm)
    {
        //prelevare i dati -> sono già nella request
        //verificare i dati
            $dati = $request->validated();
        //preparare il model
            $idFilm->fill($dati);
        //salvare
            $idFilm->save();
        //return risorsa modificata
            return new FilmResource($idFilm);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Film  $idFilm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Film $idFilm)
    {
        $idFilm->deleteOrFail();
        return response()->noContent();
    }
}
