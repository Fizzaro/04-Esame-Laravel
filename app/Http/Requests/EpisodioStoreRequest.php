<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EpisodioStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'idSerie' => 'required|integer',
            'titolo' => 'required|string|max:255',
            'durata' => 'required|integer',
            'descrizione' => 'required|string|max:255',
            'annoUscita' => 'required|string',
            'numStagione' => 'required|integer',
            'numEpisodio' => 'required|integer',
            'idVideo' => 'required|integer'
        ];
    }
}
