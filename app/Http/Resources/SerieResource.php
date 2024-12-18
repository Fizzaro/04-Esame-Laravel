<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SerieResource extends JsonResource
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
            "idSerie" => $this->idSerie,
            "idCategoria" => $this->idCategoria,
            "titolo" => $this->titolo,
            "descrizione" => $this->descrizione,
            "regista" => $this->regista,
            "produttore" => $this->produttore,
            "attori" => $this->attori,
            "annoUscita" => $this->annoUscita,
            "annoFine" => $this->annoFine,
            "totStagioni" => $this->totStagioni,
            "totEpisodi" => $this->totEpisodi,
            "idLocandina" => $this->idLocandina,
            "idTrailer" => $this->idTrailer
        ];
    }
}
