<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AjoutMessageRequest extends FormRequest
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
            'nom_complet' => 'string|required',
            'email'=>'string|email|required',
            'num_commande'=>'integer|required|exists:commandes,id',
            'sujet'=>'string|required',
            'message'=>'string|required',
        ];
    }
}
