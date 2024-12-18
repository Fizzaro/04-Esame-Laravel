<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IndirizzoResource extends JsonResource
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
            "idIndirizzo" => $this->idIndirizzo,
            "idUtente" => $this->idUtente,
            "idTipologiaIndirizzo" => $this->idTipologiaIndirizzo,
            "idComune" => $this->idComune,
            "indirizzo" => $this->indirizzo,
            "lat" => $this->lat,
            "long" => $this->long
        ];
    }
}
