<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelpers;
use App\Http\Resources\ComuneCollection;
use App\Http\Resources\ComuneResource;
use App\Models\Comune;
use Illuminate\Http\Request;

class ComuneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($cerca=request("cerca")) {
            return new ComuneCollection(Comune::where('comune', $cerca)->get());
        } else {
            return new ComuneCollection(Comune::all());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Comune  $idComune
     * @return \Illuminate\Http\Response
     */
    public function show(Comune $idComune)
    {
        $var = new ComuneResource($idComune);
        return AppHelpers::rispostaCustom($var);
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
