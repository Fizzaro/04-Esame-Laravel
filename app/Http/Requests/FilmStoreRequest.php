<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmStoreRequest extends FormRequest
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
            'idCategoria' => 'required|integer',
            'titolo' => 'required|string|max:255',
            'durata' => 'required|integer',
            'descrizione' => 'required|string|max:255',
            'regista' => 'required|string|max:255',
            'produttore' => 'required|string|max:255',
            'attori' => 'required|string|max:255',
            'annoUscita' => 'required|string',
            'idLocandina' => 'required|integer',
            'idTrailer' => 'required|integer',
            'idVideo' => 'required|integer'
        ];
    }
}
