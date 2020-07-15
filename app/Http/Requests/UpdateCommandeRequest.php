<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommandeRequest extends FormRequest
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
            'quantite' => 'nullable|integer',
            'cout_livraison' => 'nullable|numeric',
            'cout_achat' => 'nullable|numeric',
            'cout_total' => 'nullable|numeric',
            'complete' => 'nullable|boolean',
        ];
    }
}
