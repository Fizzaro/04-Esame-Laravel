<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecapitoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return
        [
            "idRecapito" => $this->idRecapito,
            "idUtente" => $this->idUtente,
            "idTipologiaRecapito" => $this->idTipologiaRecapito,
            "recapito" => $this->recapito
        ];
    }
}
