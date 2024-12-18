<?php

namespace App\Http\Requests;

use App\Http\Requests\CategoriaStoreRequest;
use App\Helpers\AppHelpers;

class CategoriaUpdateRequest extends CategoriaStoreRequest
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
        $rules = parent::rules();
        return AppHelpers::aggiornaRegoleHelper($rules);
    }
}
