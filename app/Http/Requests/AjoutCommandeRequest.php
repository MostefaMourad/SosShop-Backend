<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AjoutCommandeRequest extends FormRequest
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
            'product_id' => 'integer|required|exists:produits,id',
            'panier_id' => 'integer|required|exists:paniers,id',
            'quantite' => 'required|integer',
            'cout_livraison' => 'required|numeric',
            'cout_achat' => 'required|numeric',
            'cout_total' => 'required|numeric',
        ];
    }
}
