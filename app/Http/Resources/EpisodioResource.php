<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EpisodioResource extends JsonResource
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
            "idEpisodio" => $this->idEpisodio,
            "idSerie" => $this->idSerie,
            "titolo" => $this->titolo,
            "durata" => $this->durata,
            "descrizione" => $this->descrizione,
            "numStagione" => $this->numStagione,
            "numEpisodio" => $this->numEpisodio,
            "annoUscita" => $this->annoUscita,
            "idVideo" => $this->idVideo
        ];
    }
}
