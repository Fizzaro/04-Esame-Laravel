<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SerieStoreRequest extends FormRequest
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
            'descrizione' => 'required|string|max:255',
            'regista' => 'required|string|max:255',
            'produttore' => 'required|string|max:255',
            'attori' => 'required|string|max:255',
            'annoUscita' => 'required|string',
            'annoFine' => 'required|string',
            'totStagioni' => 'required|integer',
            'totEpisodi' => 'required|integer',
            'idLocandina' => 'required|integer',
            'idTrailer' => 'required|integer'
        ];
    }
}
