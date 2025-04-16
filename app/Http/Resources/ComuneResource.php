<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ComuneResource extends JsonResource
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
            "idComune" => $this->idComune,
            "comune" => $this->comune,
            "regione" => $this->regione,
            "citta" => $this->citta,
            "provincia" => $this->provincia,
            "cap" => $this->cap
        ];
    }
}
