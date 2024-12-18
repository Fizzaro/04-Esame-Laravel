<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FilmResource extends JsonResource
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
            "idFilm" => $this->idFilm,
            "idCategoria" => $this->idCategoria,
            "titolo" => $this->titolo,
            "durata" => $this->durata,
            "descrizione" => $this->descrizione,
            "regista" => $this->regista,
            "produttore" => $this->produttore,
            "attori" => $this->attori,
            "annoUscita" => $this->annoUscita,
            "idLocandina" => $this->idLocandina,
            "idTrailer" => $this->idTrailer,
            "idVideo" => $this->idVideo
        ];
    }
}
