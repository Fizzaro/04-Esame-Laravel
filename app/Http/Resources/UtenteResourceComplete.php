<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UtenteResourceComplete extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "idUtente" => $this->idUtente,
            "idPermesso" => $this->idPermesso,
            "idStato" => $this->idStato,
            "nome" => $this->nome,
            "cognome" => $this->cognome,
            "sesso" => $this->sesso,
            "dataNascita" => $this->dataNascita,
            "comuneNascita" => $this->comuneNascita,
            "provinciaNascita" => $this->provinciaNascita,
            "codFiscale" => $this->codFiscale,
        ];
    }
}
