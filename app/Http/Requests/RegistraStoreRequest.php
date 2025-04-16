<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistraStoreRequest extends FormRequest
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
            'nome' => 'required|string|max:45',
            'cognome' => 'required|string|max:45',
            'sesso' => 'required|integer',
            'dataNascita' => 'required|date',
            'comuneNascita' => 'required|string',
            'codFiscale' => 'required|string',
            'recapito' => 'required|string|max:255',
            'username' => 'required|string|max:45',
            'password' => 'required|string|min:8|max:45'
        ];
    }
}
