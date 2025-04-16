<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Gate;

class UtenteResource extends JsonResource
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
                "nome" => $this->nome,
                "cognome" => $this->cognome,
                "sesso" => $this->sesso,
                "dataNascita" => $this->dataNascita,
                "comuneNascita" => $this->comuneNascita,
                "codFiscale" => $this->codFiscale,
            ];
        
    }
}
