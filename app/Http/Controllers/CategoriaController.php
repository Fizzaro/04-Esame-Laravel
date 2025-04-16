<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaStoreRequest;
use App\Http\Requests\CategoriaUpdateRequest;
use App\Models\Categoria;
use App\Http\Resources\CategoriaCollection;
use App\Http\Resources\CategoriaResource;
use App\Helpers\AppHelpers;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResource
     */
    public function index()
    {
        if ($cerca=request("cerca")) {
            return new CategoriaCollection(Categoria::where('categoria', $cerca)->get());
        } else {
            return new CategoriaCollection(Categoria::all());
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\CategoriaStoreRequest  $request
     * @return JsonResource
     */
    public function store(CategoriaStoreRequest $request)
    {
        //prelevare i dati -> sono già nella request
        //verificare i dati
        $dati = $request->validated();
        $valore = Categoria::where('categoria', $dati['categoria'])->first();
        if ($valore == null) {
            //preparare il model
                $categoria = Categoria::create($dati);
            //return risorsa modificata
                return new CategoriaResource($categoria);
        } else {
            return AppHelpers::rispostaCustom(null, 'Categoria già presente', 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return JsonResource
     */
    public function show(Categoria $idCategoria)
    {
        $var = new CategoriaResource($idCategoria);
        return AppHelpers::rispostaCustom($var);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Requests\CategoriaUpdateRequest  $request
     * @param  \App\Models\Categoria  $idCategoria
     * @return JsonResource
     */
    public function update(CategoriaUpdateRequest $request, Categoria $idCategoria)
    {
        //prelevare i dati -> sono già nella request
        //verificare i dati
            $dati = $request->validated();
        //preparare il model
            $idCategoria->fill($dati);
        //salvare
            $idCategoria->save();
        //return risorsa modificata
            return new CategoriaResource($idCategoria);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $idCategoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $idCategoria)
    {
        $idCategoria->deleteOrFail();
        return response()->noContent();
    }
}
