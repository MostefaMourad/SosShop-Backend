<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AjoutLivraisonRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'nom'=>'string|required',
            'prenom'=>'string|required',
            'numero'=>'string|required',
            'adresse'=>'string|required',
            'region'=>'string|required',
            'ville'=>'string|required',
        ];
    }
}
